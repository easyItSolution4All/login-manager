<?php
class Project extends Base_Model
{
	public static $accessible = array('client_id', 'name', 'notes');
	
	public function client() {
		return $this->belongs_to('Client');
	}
}
