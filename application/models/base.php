<?php
namespace Data;

class Base_Model extends \Eloquent
{
	/**
	 * Custom method for model deletion - basically
	 * a soft-delete mechanism. Sets the deleted_at
	 * field on the model.
	 */
	public function delete() {
		$this->deleted_at = new DateTime;;
		$this->save();
	}
	
	/**
	 * Overwrite the save method so as to provide easy
	 * access to before and after save methods.
	 */
	public function save() {
		$this->before_save();
		parent::save();
		$this->after_save($this->exists);
	}

	// Default methods for overloading
	protected function before_save() {}

	// we pass in the new record value because otherwise it
	// would be impossible to ascertain, after the record has been saved.
	protected function after_save($new_record) {}
}
