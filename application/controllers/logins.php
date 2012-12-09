<?php
class Logins_Controller extends Base_Controller
{
	public function get_index()
	{
		return Response::eloquent(Login::recent());
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
		$login = Login::create($this->_data());
		$login->login_id = $login->id; // set login id for future grouping requirements
		$login->save();
	}

	public function delete_index($id) {
		$login = Login::find($id);
		if ($login) $login->delete();
	}

	/**
	 * Overloads the parent and removes the password_confirm
	 * field from the data array, to prepare for saving, as well
	 * as encoding the password field, if it's been provided.
	 *
	 * @return array
	 */
	protected function _data() {
		$data = parent::_data();
		if (!empty($data['password'])) $data['password'] = json_encode($data['password']);
		unset($data['password_confirm']);
		return $data;
	}
}
