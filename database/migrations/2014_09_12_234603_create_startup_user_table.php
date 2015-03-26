<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStartupUserTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('startup_user', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('startup_id')->unsigned()->index();
			$table->foreign('startup_id')->references('id')->on('startups')->onDelete('cascade');
			$table->integer('user_id')->unsigned()->index();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->boolean('pending');
			$table->boolean('rejected');
			$table->boolean('approved');
			$table->boolean('inactive');
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
		Schema::drop('startup_user');
	}

}
