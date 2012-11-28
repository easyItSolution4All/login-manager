<?php
class Client extends Eloquent
{
	public static $accessible = array('name', 'notes');

	public function projects() {
		return $this->has_many('Project');
	}
}