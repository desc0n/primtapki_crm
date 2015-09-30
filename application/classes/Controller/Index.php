<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Index extends Controller
{
	public function action_index()
	{
        if (!Auth::instance()->logged_in('admin')) {
            HTTP::redirect('/login');
        }

        if (Auth::instance()->logged_in() && isset($_POST['logout'])) {
            Auth::instance()->logout();
            HTTP::redirect('/');
        }

		$template=View::factory("template")
			->set('get', $_GET)
			->set('post', $_POST);
		$template->content = View::factory("index");
		$this->response->body($template);
	}

    public function action_login()
	{
        if (!Auth::instance()->logged_in() && isset($_POST['login'])) {
            Auth::instance()->login($_POST['username'], $_POST['password'],true);
            HTTP::redirect('/');
        }

		$template=View::factory("login")
			->set('post', $_POST);

		$this->response->body($template);
	}
}