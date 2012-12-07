<?php
namespace Data;

class Login extends Base_Model
{
	/**
	 * Provides the relationship back to the login table, if
	 * the record actually has it specified. 
	 */
	public function reference() {
		return $this->belongs_to('Data\\Login', 'login_id');
	}

	public function project() {
		return $this->belongs_to('Data\\Project');
	}
	
	public function favourites() {
		return $this->has_many('Data\\Favourite');
	}

	/**
	 * Saves a record to the Log table, letting admins know
	 * when/where/if a login has been created or modfied
	 * in any way.
	 *
	 * @param boolean $new_record
	 */
	protected function after_save($new_record) {
		$message = Auth::user()->name . ($new_record ? ' created a new login' : 'updated an existing login');

		\Login_Manager\Log::create(array(
			'type' => 'login',
			'user_id' => Auth::user()->id,
			'message' => $message,
			'details' => $this->to_array()
		));
	}
}