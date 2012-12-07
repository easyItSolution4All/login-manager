<?php
use \Data\Project;

class Projects_Controller extends Base_Controller
{
	public function get_index()
	{
		$query = DB::table('projects');
		$query->join('clients', 'clients.id', '=', 'projects.client_id');
		$query->order_by('clients.name', 'asc');
		$query->order_by('projects.name', 'asc');
		$query->where_null('projects.deleted_at');
		$query->where_null('clients.deleted_at');
		
		return Response::json($query->get(array('projects.id', 'projects.client_id', 'projects.name', 'projects.updated_at', 'projects.notes', 'clients.name AS client_name')));
	}
	
	public function get_view($id) {
		return Response::eloquent(Project::find($id));
	}
	
	public function post_update($id) {
		$project = Project::find($id);
		$project->fill($this->_data());
		$project->save();
	}
	
	public function post_index()
	{
		Project::create($this->_data());
	}
	
	public function delete_index($id) {
		$project = Project::find($id);
		if ($project) $project->delete();
	}
}
