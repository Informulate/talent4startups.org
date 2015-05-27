<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProfessions extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('professions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
		});

		Schema::table('profiles', function(Blueprint $table)
		{
			$table->integer('profession_id')->index();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('professions');

		Schema::table('profiles', function(Blueprint $table)
		{
			$table->dropColumn('profession_id');
		});
	}

}
