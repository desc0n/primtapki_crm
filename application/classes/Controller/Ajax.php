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
}