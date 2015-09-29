<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Index extends Controller {

	public function action_index()
	{
		$template=View::factory("template")
			->set('get', $_GET)
			->set('post', $_POST);
		$template->content = View::factory("index");
		$this->response->body($template);
	}
}