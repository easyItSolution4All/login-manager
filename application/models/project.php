<?php
class Project extends Eloquent
{
	public static $accessible = array('client_id', 'name', 'notes');
	
	public function client() {
		$this->belongs_to('Client');
	}
}
