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

    public function setCustomer($params)
    {
        $res = DB::query(Database::INSERT, 'INSERT INTO `customers__list` (`manager_id`) VALUES (:manager_id)')
            ->param(':manager_id', $this->user_id)
            ->execute();

        $customerId = Arr::get($res, 0);

        DB::query(Database::INSERT, 'INSERT INTO `customers__data`
            (`customers_id`, `name`, `postindex`, `region`, `city`, `street`, `house`, `phone`, `fax`, `email`, `site`, `date`)
            VALUES (:customer_id, :name, :postindex, :region, :city, :street, :house, :phone, :fax, :email, :site, :date)')
            ->param(':customer_id', $customerId)
            ->param(':name', $params['name'])
            ->param(':postindex', $params['postindex'])
            ->param(':region', $params['region'])
            ->param(':city', $params['city'])
            ->param(':street', $params['street'])
            ->param(':house', $params['house'])
            ->param(':phone', $params['phone'])
            ->param(':fax', $params['fax'])
            ->param(':site', $params['site'])
            ->param(':email', $params['email'])
            ->param(':date', date('Y-m-d', strtotime($params['date'])))
            ->execute();
    }

    public function findAllCustomer()
    {
        return DB::query(Database::SELECT, "
            SELECT `cd`.*,
            IF (`cd`.`postindex` != '', CONCAT(`cd`.`postindex`, ' '), '') as `postindex`,
            IF (`cd`.`region` != '', CONCAT(`cd`.`region`, ' '), '') as `region`,
            IF (`cd`.`city` != '', CONCAT('г. ', `cd`.`city`, ' '), '') as `city`,
            IF (`cd`.`street` != '', CONCAT('ул. ', `cd`.`street`, ' '), '') as `street`,
            IF (`cd`.`house` != '', CONCAT('д. ', `cd`.`house`, ' '), '') as `house`,
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
}
?>