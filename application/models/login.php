<?php
class Login extends Base_Model
{
	/**
	 * Provides the relationship back to the login table, if
	 * the record actually has it specified. 
	 */
	public function reference() {
		return $this->belongs_to('Login', 'login_id');
	}

	public function project() {
		return $this->belongs_to('Project');
	}
	
	public function favourites() {
		return $this->has_many('Favourite');
	}
}