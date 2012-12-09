<?php

class Add_References_Field_To_Logins {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('logins', function($table) {
			$table->integer('reference')->nullable();
			$table->index('reference');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('logins', function($table) {
			$table->drop_column('reference');
			$table->drop_index('reference');
		});
	}

}