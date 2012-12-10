<?php
namespace Data;

class User extends \Eloquent
{
	// Hide certain columns
	public static $hidden = array('password');
	
	public function favourites() {
		return $this->has_many('Data\\Favourite');
	}
}
