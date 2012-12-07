<?php
namespace Data;

class Favourite extends \Eloquent
{
	public function user() {
		return $this->belongs_to('Data\\User');
	}

	public function login() {
		return $this->belongs_to('Data\\Login');
	}
}
