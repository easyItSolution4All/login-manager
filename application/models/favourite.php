<?php
class Favourite extends Eloquent
{
	public function user() {
		return $this->belongs_to('User');
	}

	public function login() {
		return $this->belongs_to('Login');
	}
}
