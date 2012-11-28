<?php
class Login extends Eloquent
{
	public function project() {
		return $this->belongs_to('Project');
	}
}