<?php
use \Data\Login;
use \Data\Log;

class Logins_Controller extends Base_Controller
{
	public function get_index()
	{
		return Response::eloquent(Login::recent());
	}
	
	public function get_view($id) {
		$login = Login::with(array('logs', 'versions'))->where_id($id)->first();

		return Response::eloquent($login);
	}

	public function post_update($id) {
		$login = Login::find($id);
		$login->fill($this->_data());
		$login->save();
	}
	
	public function post_index()
	{
		$login = Login::create($this->_data());
	}

	public function delete_index($id) {
		$login = Login::find($id);
		if ($login) $login->delete();
	}

	/**
	 * This method is purely for logging user access
	 * to logins and their credentials.
	 */
	public function post_access() {
		$data = Input::json();
		$login = Login::with(array('project', 'project.client'))->where_id($data->id)->first();

		// Save the new log data for the Login access
		$log = new Log;
		$log->type = 'login-access';
		$log->foreign_id = $login->id;
		$log->user_id = Auth::user()->id;
		$log->message = Auth::user()->name . ' accessed "' . $login->name . '" from client "'.$login->project->client->name.'".';
		$log->save();
	}

	/**
	 * Overloads the parent and removes the password_confirm
	 * field from the data array, to prepare for saving, as well
	 * as encoding the password field, if it's been provided.
	 *
	 * @return array
	 */
	protected function _data($input = array()) {
		$data = parent::_data($input);
		if (!empty($data['password'])) $data['password'] = json_encode($data['password']);
		unset($data['password_confirm']);
		return $data;
	}
}
