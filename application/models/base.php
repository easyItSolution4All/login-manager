<?php
namespace Data;

class Base_Model extends \Eloquent
{
	public static $soft_delete = true;
	
	/**
	 * Custom method for model deletion - basically
	 * a soft-delete mechanism. Sets the deleted_at
	 * field on the model.
	 */
	public function delete() {
		if (static::$soft_delete) {
			$this->deleted_at = new \DateTime;;
			$this->save();
		}
		else {
			parent::delete();
		}
	}
	
	/**
	 * Overwrite the save method so as to provide easy
	 * access to before and after save methods.
	 */
	public function save() {
		// we save this information before saving, because as soon as the
		// object is created on the database, this evaluates to true.
		$exists = $this->exists;
		$original = $this->original;

		$this->before_save($exists, $original);
		parent::save();
		$this->after_save($exists, $original);
	}

	// Default methods for overloading
	protected function before_save($exists, $original) {}

	// we pass in the new record value because otherwise it
	// would be impossible to ascertain, after the record has been saved.
	protected function after_save($exists, $original) {}
}
