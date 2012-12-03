<?php
class Users_Controller extends Base_Controller
{
	public function get_index()
	{
		return View::make('home.index');
	}
	
	public function get_view($id)
	{
		if ($id == Auth::user()->id)
			return Response::eloquent(User::where_id($id)->first(array('email', 'name')));
		else
			return $this->_message('error', 'You do not have access to that account.');
	}
	
	// for user profile updates - ensures the user is only ever
	// updating their own account.
	public function post_update() {
		
	}
}
