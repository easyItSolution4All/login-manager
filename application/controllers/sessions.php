<?php
class Sessions_Controller extends Base_Controller
{
	public function delete_index()
	{
		Auth::logout();
		return $this->_message('success', 'Logout successful.');
	}

	public function post_create() {
		$data = Input::get();
	}

	public function get_index() {
		$status = !Auth::check() ? 401 : 200;
		return Response::json(array(), $status);
	}
}
