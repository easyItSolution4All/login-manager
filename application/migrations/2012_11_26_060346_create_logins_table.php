<?php

class Create_Logins_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('logins', function($table) {
			$table->increments('id');
			$table->integer('project_id');
			$table->integer('login_id')->nullable(); // logins can reference other logins, and use their details instead. This is great for things like Tectonic PHPFog services
			$table->string('name', 255);
			$table->string('type', 20);
			$table->string('location', 255);
			$table->text('notes');
			$table->string('login', 50);
			$table->string('password', 50);
			$table->string('database', 50);
			$table->string('port', 5);
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
		Schema::drop('logins');
	}

}