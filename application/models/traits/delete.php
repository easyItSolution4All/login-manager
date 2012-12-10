<?php
namespace Data\Trait;

class Deletism
{
	// We don't want to allow soft-deletion mechanisms here
	public static $soft_delete = false;

	/**
	 * Custom method for model deletion - basically
	 * a soft-delete mechanism. Sets the deleted_at
	 * field on the model.
	 */
	public function delete() {
		if ($soft_delete && array_key_exists($this->attributes['deleted_at'])) {
			$this->deleted_at = new \DateTime;;
			$this->save();
		}
		else {
			parent::delete();
		}
	}
}