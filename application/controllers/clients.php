<?php
use \Data\Client;

class Clients_Controller extends Base_Controller
{
	public function get_index()
	{
		return Response::eloquent(Client::where_null('deleted_at')->order_by('name', 'asc')->get());
	}
	
	public function get_view($id) {
		return Response::eloquent(Client::find($id));
	}
	
	public function post_update($id) {
		$client = Client::find($id);
		$client->fill($this->_data());
		$client->save();
	}
	
	public function post_index()
	{
		Client::create($this->_data());
	}

	public function delete_index($id) {
		$client = Client::find($id);
		if ($client) $client->delete();
	}
}
