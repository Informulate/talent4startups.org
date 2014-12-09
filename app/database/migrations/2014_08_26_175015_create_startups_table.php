<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStartupsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('startups', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->index()->references('id')->on('users')->onDelete('cascade');
			$table->string('name');
			$table->text('description');
			$table->string('url')->unique()->index();
			$table->string('image');
			$table->string('video');
			$table->integer('stage_id')->references('id')->on('stages');
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
		Schema::drop('startups');
	}

}
