<?php
namespace Data\Trait;

trait Deletism
{
	/**
	 * Custom method for model deletion - basically
	 * a soft-delete mechanism. Sets the deleted_at
	 * field on the model.
	 */
	public function delete() {
		if (array_key_exists($this->attributes['deleted_at'])) {
			$this->deleted_at = new \DateTime;
			$this->save();
		}
		else {
			parent::delete();
		}
	}
}
