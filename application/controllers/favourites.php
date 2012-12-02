<?php
class Favourites_Controller extends Base_Controller
{
	public function post_index()
	{
		$user_id = Auth::user()->id;
		$params = Input::get();
		$favourite = Favourite::where_user_id($user_id)->where_login_id($params['login_id'])->first();
		
		if ($favourite) {
			$favourite->delete();
			return $this->_message('success', 'Favourite removed.');
		}
		else {
			Favourite::create(array('user_id' => $user_id, 'login_id' => $params['login_id']));
			return $this->_message('success', 'Favourite added.');
		}
	}

	public function get_index() {
		$favourites = Favourite::with(array('login', 'login.project', 'login.project.client'))->where_user_id(Auth::user()->id);
		return Response::eloquent($favourites->get());
	}
}
