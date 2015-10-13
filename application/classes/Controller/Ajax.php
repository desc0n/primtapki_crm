<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax extends Controller
{
    public function action_check_user_phone()
    {
        /**
         * @var $adminModel Model_Admin
         */
        $adminModel = Model::factory('Admin');

        $check = count($adminModel->findCustomerBy($_POST));
        $this->response->body($check === 0 ? 0 : 1);
    }

    public function action_find_product_by_item()
    {
        /**
         * @var $adminModel Model_Admin
         */
        $adminModel = Model::factory('Admin');

        $result = json_encode($adminModel->findProductByItem(Arr::get($_POST, 'item')));
        $this->response->body($result);
    }
    public function action_find_product_by_name()
    {
        /**
         * @var $adminModel Model_Admin
         */
        $adminModel = Model::factory('Admin');

        $result = json_encode($adminModel->findProductByName(Arr::get($_POST, 'name')));
        $this->response->body($result);
    }
}