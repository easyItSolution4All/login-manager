<?php

class Base_Controller extends Controller
{
	public $restful = true;
	
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
		return get_object_vars(Input::json());
	}
}