<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Customer extends Controller
{
    public function getBaseTemplate()
    {
        return View::factory("template")
            ->set('get', $_GET)
            ->set('post', $_POST);
    }

	public function action_list()
	{
        /**
         * @var $adminModel Model_Admin
         */
        $adminModel = Model::factory('Admin');

        if (Arr::get($_POST, 'name') !== null && Arr::get($_POST, 'phone') !== null) {
            $adminModel->addCustomer($_POST);
            HTTP::redirect('/customer/list');
        }

		$template = $this->getBaseTemplate();

		$template->content = View::factory("customer_list")
            ->set('customerList', $adminModel->findAllCustomer());
		$this->response->body($template);
	}

    public function action_sending()
	{
        $template = $this->getBaseTemplate();

        $template->content = View::factory("customer_sending");
        $this->response->body($template);
	}

    public function action_info()
    {
        /**
         * @var $adminModel Model_Admin
         */
        $adminModel = Model::factory('Admin');

        $id = $this->request->param('id');

        if (Arr::get($_POST, 'name') !== null && Arr::get($_POST, 'phone') !== null) {
            $adminModel->setCustomer($id, $_POST);
            HTTP::redirect(sprintf('/customer/info/%d', $id));
        }

        if (Arr::get($_POST, 'newActionText') !== null) {
            $adminModel->addAction($_POST);
            HTTP::redirect(sprintf('/customer/info/%d', $id));
        }

        $template = $this->getBaseTemplate();

        $template->content = View::factory("customer_info")
            ->set('customerData', $adminModel->findCustomer($id));
        $this->response->body($template);
    }
}