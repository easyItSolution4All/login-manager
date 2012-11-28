<?php

class Base_Controller extends Controller
{
	public $restful = true;
	
	/**
	 * Sets up some basic rules for the application
	 */
	public function __construct() {
		parent::__construct();
		$this->filter('after', 'response');
	}

	/**
	 * Catch-all method for requests that can't be matched.
	 *
	 * @param  string    $method
	 * @param  array     $parameters
	 * @return Response
	 */
	public function __call($method, $parameters)
	{
		return Response::error('404');
	}

	/**
	 * Fetches and converts any JSON input to an array that is usable
	 * by any models throughout the system. This helps when saving data.
	 *
	 * @return array
	 */
	protected function _data() {
		return $this->_get_vars(Input::json());
	}

	/**
	 * Retrieves the data and will recursively retrieve
	 * more if an element is an object.
	 * 
	 * @param array $data
	 * @return array
	 */
	protected function _get_vars($data) {
		$data = get_object_vars($data);

		foreach ($data as $key => $value) {
			if (is_object($value)) {
				$data[$key] = $this->_get_vars($value);
			}
		}

		return $data;
	}
}