<?php

class Create_Users_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table) {
			$table->increments('id');
			$table->string('email', 50);
			$table->string('password', 60);
			$table->string('name', 50);
			$table->timestamps();
		});
		
		\Data\User::create(array('email' => 'kirk@tectonicdigital.com.au', 'password' => Hash::make('0ff1c3'), 'name' => 'Kirk Bushell'));
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}