<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalPropertiesToProfileTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('profiles', function(Blueprint $table)
		{
			$table->string('user_type')->after('last_name');
			$table->string('agerange')->after('user_type');
			$table->string('location')->after('agerange');
			$table->string('workexperience')->after('location');
			$table->text('about')->after('workexperience');
			$table->integer('describe')->after('about');
			$table->string('image');
			$table->string('another_skill')->after('describe');
			$table->string('facebook')->after('another_skill');
			$table->string('linkedins')->after('facebook');
			$table->string('twitter')->after('linkedins');
			$table->string('meetup')->after('twitter');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		
		Schema::table('profiles', function(Blueprint $table)
		{
			$table->removeColumn(['image', 'user_type','agerange','location','workexperience','about'
			,'describe','another_skill','facebook','linkedins','twitter','meetup']);
		});
	}

}
