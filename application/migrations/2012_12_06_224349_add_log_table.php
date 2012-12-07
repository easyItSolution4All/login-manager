<?php

class Add_Log_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('logs', function($table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->string('type', 20);
			$table->string('message', 255);
			$table->text('details')->nullable();
			$table->index('type');
			$table->index('user_id');
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
		Schema::drop('logs');
	}

}