<?php
class Login extends Eloquent
{
	public function project() {
		$this->belongs_to('Project');
	}
}