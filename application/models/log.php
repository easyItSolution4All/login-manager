<?php
namespace Data;

class Log extends Base_Model
{
	/**
	 * Details should be assigned to the model as an array. This
	 * method, as well as the getter, will translate that array
	 * to a string using serialize for storing in the table. This
	 * provides the developer with the ability to easily extend
	 * the logging model for storing all sorts of data.
	 *
	 * @param string $details
	 */
	public function set_details($details) {
		if (!is_array($details)) return;

		$this->set_attribute('details', json_encode($details));
	}

	/**
	 * Retrieves the details from the model and converts it back
	 * to an array for rendering and other options.
	 *
	 * @return array
	 */
	public function get_details() {
		return json_decode($this->get_attribute('details'));
	}
}