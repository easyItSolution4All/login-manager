<?php
class Clients_Controller extends Base_Controller
{
	public function get_index()
	{
		return Response::eloquent(Client::all());
	}

	public function post_index()
	{
		$data = get_object_vars(Input::json());
		
		Client::create($data);
	}
}
