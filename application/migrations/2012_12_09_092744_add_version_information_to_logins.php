<?php

class Add_Version_Information_To_Logins {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('logins', function($table) {
			$table->integer('version')->default(1);
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
			$table->drop_column('version');
		});
	}
}