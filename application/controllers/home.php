<?php
class Home_Controller extends Base_Controller
{
	public function get_index()
	{
		return View::make('home.index');
	}
}