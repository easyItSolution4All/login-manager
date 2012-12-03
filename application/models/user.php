<?php
class User extends Eloquent
{
	public static $accessible = array('email', 'name');
	
	public function favourites() {
		return $this->has_many('Favourite');
	}
}
