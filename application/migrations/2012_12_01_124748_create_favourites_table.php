<?php

class Create_Favourites_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('favourites', function($table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('login_id');
			$table->timestamps();
		});
	}
	
	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('favourites');
	}

}