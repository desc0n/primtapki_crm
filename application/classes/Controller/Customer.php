<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Customer extends Controller
{
	public function action_list()
	{
        /**
         * @var $adminModel Model_Admin
         */
        $adminModel = Model::factory('Admin');

        if (Arr::get($_POST, 'name') !== null && Arr::get($_POST, 'phone') !== null) {
            $adminModel->setCustomer($_POST);
            HTTP::redirect('/customer/list');
        }

		$template=View::factory("template")
			->set('get', $_GET)
			->set('post', $_POST);

		$template->content = View::factory("customer_list");
		$this->response->body($template);
	}

    public function action_sending()
	{
        $template=View::factory("template")
            ->set('get', $_GET)
            ->set('post', $_POST);

        $template->content = View::factory("customer_sending");
        $this->response->body($template);
	}
}