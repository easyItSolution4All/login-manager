<?php
class Clients_Controller extends Base_Controller
{
	public function get_index()
	{
		return Response::eloquent(Client::all());
	}
	
	public function post_index()
	{
		Client::create($this->_data());
	}
}
