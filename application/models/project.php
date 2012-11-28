<?php
class Project extends Eloquent
{
	public static $accessible = array('client_id', 'name', 'notes');
	
	public function client() {
		return $this->belongs_to('Client');
	}
}
