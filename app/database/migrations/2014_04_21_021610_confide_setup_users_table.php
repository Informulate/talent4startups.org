<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConfideSetupUsersTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Creates the users table
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('username');
			$table->string('email');
			$table->string('password');
			$table->string('confirmation_code');
			$table->boolean('confirmed')->default(false);
			$table->string('remember_token', 100)->nullable();
			$table->timestamps();
		});

		// Creates password reminders table
		Schema::create('password_reminders', function (Blueprint $t) {
			$t->string('email');
			$t->string('token');
			$t->timestamp('created_at');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('password_reminders');
		Schema::drop('users');
	}

}
