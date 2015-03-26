<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSocialFieldsToStartup extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('startups', function(Blueprint $table)
		{
			$table->string('facebook');
			$table->string('linked_in');
			$table->string('twitter');
			$table->string('website');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('startups', function(Blueprint $table)
		{
			$table->dropColumn('image');
		});
	}

}
