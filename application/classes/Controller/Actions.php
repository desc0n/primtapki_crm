<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Actions extends Controller
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

		$template = $this->getBaseTemplate();

		$template->content = View::factory("actions_list")
            ->set('actionsList', $adminModel->findAllActions());
		$this->response->body($template);
	}
}