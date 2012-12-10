<?php

class Add_Foreignid_To_Logs_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('logs', function($table) {
			$table->integer('foreign_id')->index()->nullable();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('logs', function($table) {
			$table->drop_column('foreign_id');
		});
	}

}