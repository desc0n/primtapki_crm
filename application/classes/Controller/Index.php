<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Index extends Controller
{
	public function action_index()
	{
        if (!Auth::instance()->logged_in('admin')) {
            HTTP::redirect('/login');
        }
		$template=View::factory("template")
			->set('get', $_GET)
			->set('post', $_POST);
		$template->content = View::factory("index");
		$this->response->body($template);
	}

    public function action_login()
	{
		$template=View::factory("login")
			->set('get', $_GET)
			->set('post', $_POST);

		$this->response->body($template);
	}
}