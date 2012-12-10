<?php

class Add_Versioning_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('versions', function($table) {
			$table->increments('id');
			$table->integer('foreign_id')->index();
			$table->string('type', 50)->index();
			$table->text('data');
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
		Schema::drop('versions');
	}

}