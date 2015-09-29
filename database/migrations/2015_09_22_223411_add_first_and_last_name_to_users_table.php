<?php

use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFirstAndLastNameToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->after('email');
            $table->string('last_name')->after('first_name');
        });

		foreach (User::all() as $user) {
			if ($user->profile) {
				$user->first_name = $user->profile->first_name;
				$user->last_name = $user->profile->last_name;
				$user->save();
			}
		}

		Schema::table('profiles', function(Blueprint $table) {
			$table->dropColumn(['first_name', 'last_name']);
		});
	}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('profiles', function(Blueprint $table) {
			$table->string('first_name');
			$table->string('last_name');
		});

		foreach (User::all() as $user) {
			if ($user->profile) {
				$user->profile->first_name = $user->first_name;
				$user->profile->last_name = $user->last_name;
				$user->save();
				$user->profile->save();
			}
		}

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['first_name', 'last_name']);
        });
    }
}
