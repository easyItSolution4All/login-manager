<?php
class User extends Eloquent
{
	public function favourites() {
		return $this->has_many('Favourite');
	}
}
