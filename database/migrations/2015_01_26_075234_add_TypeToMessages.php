<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddTypeToMessages extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('messages', function(Blueprint $table)
        {
            $table->enum('type', array('message', 'notification'))->default('message');
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('messages', function(Blueprint $table)
		{
			$table->dropColumn(array('type'));
		});
	}

}
