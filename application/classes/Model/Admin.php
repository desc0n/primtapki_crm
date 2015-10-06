<?php

/**
 * Class Model_Admin
 */
class Model_Admin extends Kohana_Model
{

	private $user_id;

	public function __construct()
	{
		if (Auth::instance()->logged_in()) {
			$this->user_id = Auth::instance()->get_user()->id;
		} else {
			$this->user_id = null;
		}
		DB::query(Database::UPDATE, "SET time_zone = '+10:00'")->execute();
	}

	public function findCustomerBy($params = [])
    {
        $where = '';

        if (Arr::get($params, 'phone') !== null) {
            $where .= sprintf('AND `phone` = %s', preg_replace('/[^0-9]+/i', '', Arr::get($params, 'phone')));
        }

        return DB::query(Database::SELECT, sprintf('SELECT * FROM `customers__data` WHERE 1 %s', $where))
            ->execute()
            ->as_array();
    }

    public function addCustomer($params)
    {
        $res = DB::query(Database::INSERT, 'INSERT INTO `customers__list` (`manager_id`) VALUES (:manager_id)')
            ->param(':manager_id', $this->user_id)
            ->execute();

        $customerId = Arr::get($res, 0);

        $this->setCustomer($customerId, $params);

        return $customerId;
    }

    public function setCustomer($customerId, $params)
    {
        DB::query(Database::INSERT, 'INSERT INTO `customers__data`
            (`customers_id`, `name`, `postindex`, `region`, `city`, `street`, `house`, `phone`, `fax`, `email`, `site`, `date`)
            VALUES (:customer_id, :name, :postindex, :region, :city, :street, :house, :phone, :fax, :email, :site, :date)
            ON DUPLICATE KEY UPDATE `name` = :name, `postindex` = :postindex, `region` = :region, `city` = :city,
            `street` = :street, `house` = :house, `fax` = :fax, `site` = :site, `email` = :email')
            ->param(':customer_id', $customerId)
            ->param(':name', Arr::get($params, 'name'))
            ->param(':postindex', Arr::get($params, 'postindex'))
            ->param(':region', Arr::get($params, 'region'))
            ->param(':city', Arr::get($params, 'city'))
            ->param(':street', Arr::get($params, 'street'))
            ->param(':house', Arr::get($params, 'house'))
            ->param(':phone', Arr::get($params, 'phone'))
            ->param(':fax', Arr::get($params, 'fax'))
            ->param(':site', Arr::get($params, 'site'))
            ->param(':email', Arr::get($params, 'email'))
            ->param(':date', date('Y-m-d', strtotime(Arr::get($params, 'date', '0000-00-00'))))
            ->execute();
    }

    public function findAllCustomer()
    {
        return DB::query(Database::SELECT, "
            SELECT `cd`.*,
            IF (`cd`.`postindex` != '', CONCAT(`cd`.`postindex`, ' '), '') as `listview_postindex`,
            IF (`cd`.`region` != '', CONCAT(`cd`.`region`, ' '), '') as `listview_region`,
            IF (`cd`.`city` != '', CONCAT('г. ', `cd`.`city`, ' '), '') as `listview_city`,
            IF (`cd`.`street` != '', CONCAT('ул. ', `cd`.`street`, ' '), '') as `listview_street`,
            IF (`cd`.`house` != '', CONCAT('д. ', `cd`.`house`, ' '), '') as `listview_house`,
            `up`.`name` as `manager_name`
            FROM `customers__data` `cd`
            INNER JOIN `customers__list` `cl`
                ON `cl`.`id` = `cd`.`customers_id`
            INNER JOIN `users__profile` `up`
                ON `up`.`user_id` = `cl`.`manager_id`
        ")
            ->execute()
            ->as_array();
    }

    public function findCustomer($id)
    {
        $customers = $this->findAllCustomer();

        foreach ($customers as $customer) {
            if ($customer['customers_id'] == $id) {
                return $customer;
            }
        }

        return [];
    }
}
?>