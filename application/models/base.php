<?php
class Base_Model extends Eloquent
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
}
