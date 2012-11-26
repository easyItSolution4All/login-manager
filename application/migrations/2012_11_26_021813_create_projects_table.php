<?php

class Create_Projects_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects', function($table) {
			$table->increments('id');
			$table->integer('client_id');
			$table->string('name', 255);
			$table->text('notes');
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
		Schema::drop('projects');
	}

}