<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profiles', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->index()->unique()->references('id')->on('users')->onDelete('cascade');
			$table->string('first_name')->index();
			$table->string('last_name')->index();
			$table->string('location');
			$table->text('about');
			$table->integer('skill');
			$table->string('facebook');
			$table->string('linkedIn');
			$table->string('twitter');
			$table->string('meetup');
			$table->boolean('published');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('profiles');
	}

}
