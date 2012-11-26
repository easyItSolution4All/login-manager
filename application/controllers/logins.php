<?php
class Logins_Controller extends Base_Controller
{
	public function get_index()
	{
		return Response::eloquent(Login::all());
	}
	
	public function get_view($id) {
		return Response::eloquent(Login::find($id));
	}
	
	public function post_update($id) {
		$login = Login::find($id);
		$login->fill($this->_data());
		$login->save();
	}
	
	public function post_index()
	{
		Login::create($this->_data());
	}

	public function delete_index($id) {
		$login = Login::find($id);
		if ($login) $login->delete();
	}
}
