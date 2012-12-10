<?php
namespace Data;

/**
 * Acts as the versioning connector model for all data components
 * within the system. This does result in a rather messy structure
 * of data, but it's also very capable of handling anything you
 * throw at it.
 * 
 * @author Kirk Bushell
 * @date 10th December 2012
 */
class Version extends Base_Model
{
	// We don't want to allow soft-deletion mechanisms here
	public static $soft_delete = false;

	/**
	 * Simple enough method to ensure that whenever we work with the
	 * data field, that we json_decode the string again to make it
	 * plyable.
	 */
	public function get_data() {
		return json_decode($this->get_attribute('data'));
	}
}