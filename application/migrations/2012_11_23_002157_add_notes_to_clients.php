<?php

class Add_Notes_To_Clients {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('clients', function($table) {
			$table->text('notes');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('clients', function($table) {
			$table->drop_column('notes');
		});
	}

}