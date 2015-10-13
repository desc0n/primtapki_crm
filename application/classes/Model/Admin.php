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

    public function addAction($params = [])
    {
        DB::query(Database::INSERT, 'INSERT INTO `customers__actions_list`
                (`manager_id`, `customer_id`, `text`, `date`)
            VALUES (:manager_id, :customer_id, :text, now())')
            ->param(':manager_id', $this->user_id)
            ->param(':customer_id', Arr::get($params, 'customer_id'))
            ->param(':text', preg_replace('/[\'\"]+/', '', Arr::get($params, 'newActionText')))
            ->execute();
    }

    public function findAllActions()
    {
        return DB::query(Database::SELECT, "
            SELECT `cal`.*,
            `up`.`name` as `manager_name`
            FROM `customers__actions_list` `cal`
            INNER JOIN `users__profile` `up`
                ON `up`.`user_id` = `cal`.`manager_id`
        ")
            ->execute()
            ->as_array();
    }

    public function findActionBy($params = [])
    {
        $where = '';

        if (Arr::get($params, 'customer_id') !== null) {
            $where .= sprintf('AND `cal`.`customer_id` = %s', preg_replace('/[^0-9]+/i', '', Arr::get($params, 'customer_id')));
        }

        return DB::query(Database::SELECT, sprintf('
            SELECT `cal`.*,
            `up`.`name` as `manager_name`
            FROM `customers__actions_list` `cal`
            INNER JOIN `users__profile` `up`
                ON `up`.`user_id` = `cal`.`manager_id` WHERE 1 %s
            ', $where))
                ->execute()
                ->as_array();
    }

    public function findProductByItem($item)
    {
        return DB::query(Database::SELECT, "
            select `ia`.`value` as `availibility`,
            `iab`.`value` as `about`,
            `icm`.`value` as `catalog_manufacturer`,
            `icat`.`value` as `category_id`,
            `icapacity`.`value` as `capacity`,
            `icharge`.`value` as `charge`,
            `c`.`name` as `category`,
            `iconstr`.`value` as `construction`,
            `ic`.`value` as `country`,
            `icompl`.`value` as `complect`,
            `icont`.`value` as `contact`,
            `id`.`value` as `diameter`,
            `idel`.`num` as `delivery_num`,
            `idel`.`cities` as `delivery_cities`,
            `idesc`.`value` as `discription`,
            `ifs`.`value` as `full_size`,
            `ii`.`item_id`,
            `iimg`.`img_1`,
            `iimg`.`img_2`,
            `iimg`.`img_3`,
            `iimg`.`img_4`,
            `iimg`.`img_5`,
            `iimg`.`img_6`,
            `il`.`value` as `link`,
            `ih`.`value` as `height`,
            `im`.`value` as `manufacturer`,
            `imod`.`value` as `model`,
            `ip`.`value` as `price`,
            `ipost`.`autor` as `post_autor`,
            `ipost`.`text` as `post_text`,
            `iseas`.`value` as `season`,
            `is`.`value` as `size`,
            `isp`.`value` as `speed`,
            `it`.`value` as `type`,
            `ititle`.`value` as `title`,
            `iu`.`value` as `usability`,
            `iweight`.`value` as `weight`,
            `iw`.`value` as `width`
            from `primtapki_vikamorgan`.`items_id` `ii`
            left join `primtapki_vikamorgan`.`items_about` `iab`
                on `iab`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_availability` `ia`
                on `ia`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_catalog_manufacturer` `icm`
                on `icm`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_category` `icat`
                on `icat`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_contact` `icont`
                on `icont`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`categories` `c`
                on `c`.`id` = `icat`.`value`
            left join `primtapki_vikamorgan`.`items_construction` `iconstr`
                on `iconstr`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_complect` `icompl`
                on `icompl`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_capacity` `icapacity`
                on `icapacity`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_charge` `icharge`
                on `icharge`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_country` `ic`
                on `ic`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_diameter` `id`
                on `id`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_delivery` `idel`
                on `idel`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_description` `idesc`
                on `idesc`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_full_size` `ifs`
                on `ifs`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_imgs` `iimg`
                on `iimg`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_manufacturer` `im`
                on `im`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_model` `imod`
                on `imod`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_height` `ih`
                on `ih`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_price` `ip`
                on `ip`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_post` `ipost`
                on `ipost`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_season` `iseas`
                on `iseas`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_size` `is`
                on `is`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_type` `it`
                on `it`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_title` `ititle`
                on `ititle`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_link` `il`
                on `il`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_usability` `iu`
                on `iu`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_weight` `iweight`
                on `iweight`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_width` `iw`
                on `iw`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_speed` `isp`
                on `isp`.`item` = `ii`.`id`
            where `ii`.`item_id` like :item
        ")
            ->param(':item', sprintf('%%%s%%', $item))
            ->execute()
            ->as_array();
    }

    public function findProductByName($name)
    {
        return DB::query(Database::SELECT, "
            select `ia`.`value` as `availibility`,
            `iab`.`value` as `about`,
            `icm`.`value` as `catalog_manufacturer`,
            `icat`.`value` as `category_id`,
            `icapacity`.`value` as `capacity`,
            `icharge`.`value` as `charge`,
            `c`.`name` as `category`,
            `iconstr`.`value` as `construction`,
            `ic`.`value` as `country`,
            `icompl`.`value` as `complect`,
            `icont`.`value` as `contact`,
            `id`.`value` as `diameter`,
            `idel`.`num` as `delivery_num`,
            `idel`.`cities` as `delivery_cities`,
            `idesc`.`value` as `discription`,
            `ifs`.`value` as `full_size`,
            `ii`.`item_id`,
            `iimg`.`img_1`,
            `iimg`.`img_2`,
            `iimg`.`img_3`,
            `iimg`.`img_4`,
            `iimg`.`img_5`,
            `iimg`.`img_6`,
            `il`.`value` as `link`,
            `ih`.`value` as `height`,
            `im`.`value` as `manufacturer`,
            `imod`.`value` as `model`,
            `ip`.`value` as `price`,
            `ipost`.`autor` as `post_autor`,
            `ipost`.`text` as `post_text`,
            `iseas`.`value` as `season`,
            `is`.`value` as `size`,
            `isp`.`value` as `speed`,
            `it`.`value` as `type`,
            `ititle`.`value` as `title`,
            `iu`.`value` as `usability`,
            `iweight`.`value` as `weight`,
            `iw`.`value` as `width`
            from `primtapki_vikamorgan`.`items_id` `ii`
            left join `primtapki_vikamorgan`.`items_about` `iab`
                on `iab`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_availability` `ia`
                on `ia`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_catalog_manufacturer` `icm`
                on `icm`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_category` `icat`
                on `icat`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_contact` `icont`
                on `icont`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`categories` `c`
                on `c`.`id` = `icat`.`value`
            left join `primtapki_vikamorgan`.`items_construction` `iconstr`
                on `iconstr`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_complect` `icompl`
                on `icompl`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_capacity` `icapacity`
                on `icapacity`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_charge` `icharge`
                on `icharge`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_country` `ic`
                on `ic`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_diameter` `id`
                on `id`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_delivery` `idel`
                on `idel`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_description` `idesc`
                on `idesc`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_full_size` `ifs`
                on `ifs`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_imgs` `iimg`
                on `iimg`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_manufacturer` `im`
                on `im`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_model` `imod`
                on `imod`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_height` `ih`
                on `ih`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_price` `ip`
                on `ip`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_post` `ipost`
                on `ipost`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_season` `iseas`
                on `iseas`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_size` `is`
                on `is`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_type` `it`
                on `it`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_title` `ititle`
                on `ititle`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_link` `il`
                on `il`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_usability` `iu`
                on `iu`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_weight` `iweight`
                on `iweight`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_width` `iw`
                on `iw`.`item` = `ii`.`id`
            left join `primtapki_vikamorgan`.`items_speed` `isp`
                on `isp`.`item` = `ii`.`id`
            where `ifs`.`value` like :name or `imod`.`value` like :name
        ")
            ->param(':name', sprintf('%%%s%%', $name))
            ->execute()
            ->as_array();
    }

    public function addCustomerProduct($params = [])
    {
        DB::query(Database::INSERT, 'INSERT INTO `customers__products`
                (`manager_id`, `customer_id`, `product_code`, `product_name`, `date`)
            VALUES (:manager_id, :customer_id, :product_code, :product_name, now())')
            ->param(':manager_id', $this->user_id)
            ->param(':customer_id', Arr::get($params, 'customer_id'))
            ->param(':product_code', preg_replace('/[\'\"]+/', '', Arr::get($params, 'newProductCode')))
            ->param(':product_name', preg_replace('/[\'\"]+/', '', Arr::get($params, 'newProductName')))
            ->execute();
    }

    public function findProductBy($params = [])
    {
        $where = '';

        if (Arr::get($params, 'customer_id') !== null) {
            $where .= sprintf('AND `cp`.`customer_id` = %s', preg_replace('/[^0-9]+/i', '', Arr::get($params, 'customer_id')));
        }

        return DB::query(Database::SELECT, sprintf('
            SELECT `cp`.*,
            `up`.`name` as `manager_name`
            FROM `customers__products` `cp`
            INNER JOIN `users__profile` `up`
                ON `up`.`user_id` = `cp`.`manager_id` WHERE 1 %s
            ', $where))
            ->execute()
            ->as_array();
    }
}
?>