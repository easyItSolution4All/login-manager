<?php
class Login extends Base_Model
{
	/**
	 * Provides the relationship back to the login table, if
	 * the record actually has it specified. 
	 */
	public function reference() {
		return $this->belongs_to('Login', 'reference');
	}

	public function project() {
		return $this->belongs_to('Project');
	}
	
	public function favourites() {
		return $this->has_many('Favourite');
	}

	/**
	 * Returns the most recent logins, based on the most recent version
	 * of each login.
	 *
	 * @return array
	 */
	public static function recent() {
		return Login::with(array('reference', 'project', 'project.client'))->where_null('deleted_at')->get();
		
		$query = Login::with(array('reference', 'project', 'project.client'));
		$query->join('');
		$query->where_null('deleted_at');

		return $query->get();
	}
}