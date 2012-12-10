<?php
use \Data\Version;

class Versions_Controller extends Base_Controller
{
	public function delete_index($id) {
		$login = Version::find($id);
		if ($login) $login->delete();
	}

	/**
	 * Reverting a provided version sets the 
	 * type's record to the version requested, and
	 * creates another historical record.
	 *
	 * @param integer $id
	 */
	public function post_revert($id) {
		$version = Version::find($id);

		$model = Str::classify($version->type);
		$data  = $this->_data($version->data);

		// Dynamically call the class based on the Version type (in most cases, 'login')
		$object = forward_static_call_array(array('\Data\\'.$model, 'find'), array($version->foreign_id));
		$object->fill($data);
		$object->save();
	}
}
