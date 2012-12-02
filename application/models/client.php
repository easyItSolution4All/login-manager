<?php
class Client extends Base_Model
{
	public static $accessible = array('name', 'notes');

	public function projects() {
		return $this->has_many('Project');
	}
}