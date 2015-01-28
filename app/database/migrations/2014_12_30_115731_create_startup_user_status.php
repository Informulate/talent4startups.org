<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStartupUserStatus extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('startup_user', function(Blueprint $table)
            {
                $table->dropColumn(array('pending', 'rejected', 'approved', 'inactive'));
                $table->enum('status', array('pending', 'approved', 'rejected', 'assigned', 'delivered'))->after('user_id')->index();
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

        Schema::table('startup_user', function(Blueprint $table)
            {
                $table->dropColumn('status');
                $table->boolean('pending');
                $table->boolean('rejected');
                $table->boolean('approved');
                $table->boolean('inactive');
            });
	}

}
