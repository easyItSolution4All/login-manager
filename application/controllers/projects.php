<?php
class Projects_Controller extends Base_Controller
{
	public function get_index()
	{
		return Response::eloquent(Project::all());
	}
	
	public function post_index()
	{
		Project::create($this->_data());
	}
}
