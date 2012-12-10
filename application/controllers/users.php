<?php
use \Data\User;

class Users_Controller extends Base_Controller
{
	public function get_index()
	{
		return View::make('home.index');
	}
	
	/**
	 * For user profile updates - ensures the user is
	 * only ever updating their own account.
	 */
	public function get_profile() {
		return Response::eloquent(User::where_id(\Auth::user()->id)->first(array('email', 'name')));
	}
	
	/**
	 * For saving the profile information entered by a user
	 */
	public function post_profile() {
		$data = $this->_data();
		$user = User::find(\Auth::user()->id);

		if ($user) {
			if (!empty($data['password'])) {
				$user->password = \Hash::make($data['password']);
			}

			$user->fill($data);
			$user->save();

			return $this->_message('success', 'Settings saved.');
		}

		return $this->_message('error', 'User not found.');
	}
}
