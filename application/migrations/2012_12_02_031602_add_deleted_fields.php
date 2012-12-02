<?php

class Add_Deleted_Fields {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table) { $table->date('deleted_at')->nullable(); });
		Schema::table('clients', function($table) { $table->date('deleted_at')->nullable(); });
		Schema::table('projects', function($table) { $table->date('deleted_at')->nullable(); });
		Schema::table('logins', function($table) { $table->date('deleted_at')->nullable(); });
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function($table) { $table->drop_column('deleted_at'); });
		Schema::table('clients', function($table) { $table->drop_column('deleted_at'); });
		Schema::table('projects', function($table) { $table->drop_column('deleted_at'); });
		Schema::table('logins', function($table) { $table->drop_column('deleted_at'); });
	}

}