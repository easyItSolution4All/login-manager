<?php
class Client extends Eloquent
{
	public static $accessible = array('name', 'notes');
}