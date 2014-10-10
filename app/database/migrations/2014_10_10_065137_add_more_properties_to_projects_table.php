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
			$table->string('goal1')->after('description');
			$table->string('goal2')->after('goal1');
			$table->integer('stage_id')->after('goal2');
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
			$table->removeColumn(['goal1', 'goal2','stage_id','status']);
		});
	}

}
