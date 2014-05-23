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
		// Creates contact_methods table;
		Schema::create('contact_methods', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->unique;
			$table->string('slug')->unique;
			$table->timestamps();
		});
		// Creates the users table
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('username');
			$table->string('email');
			$table->string('password');
			$table->string('confirmation_code');
			$table->boolean('confirmed')->default(false);
			$table->string('remember_token', 100)->nullable();
			$table->string('first_name');
			$table->string('last_name');
			$table->string('address');
			$table->boolean('address_public')->default(false);
			$table->string('phone_number');
			$table->boolean('phone_number_public')->default(false);
			$table->string('github_username');
			$table->string('twitter_username');
			$table->string('linkedin_username');
			$table->integer('contact_method_id')->unsigned()->index();
			$table->foreign('contact_method_id')->references('id')->on('contact_methods')->onDelete('cascade');
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
		Schema::drop('contact_methods');
	}

}
