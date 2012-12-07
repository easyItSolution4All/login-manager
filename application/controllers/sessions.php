<?php

class Sessions_Controller extends Base_Controller
{
	/**
	 * Deletes a user's session, effectively logging them out
	 */
	public function delete_index()
	{
		Auth::logout();
		return $this->_message('success', 'Logout successful');
	}
	
	/**
	 * Handles the creation of new sessions, by checking
	 * user-submitted login information against the users
	 * table, utilizing the Auth class.
	 */
	public function post_index() {
		$data = Input::get();
		$data['username'] = $data['email'];
		unset($data['email']);
		
		if (Auth::attempt($data))
			return $this->_message('success', 'Welcome back!');
		else
			return $this->_message('error', 'Auth failure', 401);
	}

	/**
	 * Login check, returns a JSON response of the user object on
	 * success, or a 401 unauthorized JSON response on failure.
	 */
	public function get_index() {
		if (Auth::check()) {
			$user = Auth::user();
			$return = array('id' => $user->id, 'name' => $user->name, 'favourites' => $user->favourites()->lists('login_id'));
			return Response::json($return);
		}
		else {
			return $this->_message('error', 'User not authorised', 401);
		}
	}
}
