<?php
namespace Data;

class Login extends Base_Model
{
	/**
	 * Provides the relationship back to the login table, if
	 * the record actually has it specified. 
	 */
	public function reference() {
		return $this->belongs_to('Data\\Login', 'reference');
	}

	public function project() {
		return $this->belongs_to('Data\\Project');
	}
	
	public function favourites() {
		return $this->has_many('Data\\Favourite');
	}
	
	/**
	 * Returns historical versioning for the Login
	 */
	public function versions() {
		return $this->has_many('Data\\Version','foreign_id')->where('type','=', 'login')->order_by('created_at', 'desc');
	}

	/**
	 * Returns a list of accesses for a given login
	 */
	public function logs() {
		return $this->has_many('Data\\Log', 'foreign_id')->where_in('type', array('login', 'login-access'));
	}

	/**
	 * Used to create the versioning record with the old data,
	 * before the new login record has been saved, but only
	 * for updating records, not new ones (obviously there is
	 * no data available for new login records).
	 */
	protected function before_save() {
		if ($this->exists and $this->dirty()) {
			$data = array(
				'foreign_id' => $this->id,
				'type' => 'login',
				'data' => json_encode($this->to_array())
			);

			Version::create($data);
		}
	}
	
	/**
	 * Saves a record to the Log table, letting admins know
	 * when/where/if a login has been created or modfied
	 * in any way.
	 * 
	 * @param boolean $new_record
	 */
	protected function after_save($exists) {
		$message = \Auth::user()->name . (!$exists ? ' created a new login.' : ' updated an existing login.');

		Log::create(array(
			'type' => 'login',
			'foreign_id' => $this->id,
			'user_id' => \Auth::user()->id,
			'message' => $message,
			'details' => $this->to_array()
		));
	}

	/**
	 * Returns the most recent logins, based on the most recent version
	 * of each login.
	 * 
	 * @return array
	 */
	public static function recent() {
		return Login::with(array('reference', 'project', 'project.client'))->where_null('deleted_at')->get();
	}
}