<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMorePropertiesToProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('projects',function(Blueprint $table){
			$table->string('goal')->after('description'); 
			$table->integer('stage_id')->after('goal');
			$table->enum('status', array('0', '1'))->after('video');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('projects', function(Blueprint $table)
		{
			$table->removeColumn(['goal' ,'stage_id','status']);
		});
	}

}
