<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Customer extends Controller
{
    public function getBaseTemplate()
    {
        return View::factory('template')
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
            $customerId = $adminModel->addCustomer($_POST);
            HTTP::redirect(sprintf('/customer/info/%d', $customerId));
        }

		$template = $this->getBaseTemplate();

		$template->content = View::factory('customer_list')
            ->set('customerList', $adminModel->findAllCustomer())
            ->set('customerTypes', $adminModel->findAllCustomerTypes());
		$this->response->body($template);
	}

    public function action_sending()
	{
        $template = $this->getBaseTemplate();

        $template->content = View::factory('customer_sending');
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
            $_POST['customer_id'] = $id;
            $adminModel->addAction($_POST);
            HTTP::redirect(sprintf('/customer/info/%d', $id));
        }

        if (Arr::get($_POST, 'newProductCode') !== null) {
            $_POST['customer_id'] = $id;
            $adminModel->addCustomerProduct($_POST);
            HTTP::redirect(sprintf('/customer/info/%d', $id));
        }

        if (!empty(Arr::get($_POST, 'newSaleProductCode', []))) {
            $_POST['customer_id'] = $id;
            $adminModel->addCustomerSale($_POST);
            HTTP::redirect(sprintf('/customer/info/%d', $id));
        }

        $template = $this->getBaseTemplate();

        $template->content = View::factory('customer_info')
            ->set('customerData', $adminModel->findCustomer($id))
            ->set('customerActions', $adminModel->findActionBy(['customer_id' => $id]))
            ->set('customerProducts', $adminModel->findProductBy(['customer_id' => $id]))
            ->set('customerSales', $adminModel->findAllCustomersSales(['customer_id' => $id]))
            ->set('communicationMethods', $adminModel->findAllCommunicationMethods())
            ->set('saleMethods', $adminModel->findAllSaleMethods())
            ->set('saleTypes', $adminModel->findAllSaleTypes())
            ->set('saleDeliveries', $adminModel->findAllSaleDeliveries())
            ->set('saleReserves', $adminModel->findAllSaleReserves())
            ->set('actionTypes', $adminModel->findAllActionTypes());
        $this->response->body($template);
    }
}
