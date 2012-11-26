<?php
class Client extends Eloquent
{
	public static $accessible = array('name', 'notes');

	public function projects() {
		$this->has_many('Project');
	}
}