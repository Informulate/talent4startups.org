<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectStageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('project_stage', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('project_id')->unsigned()->index();
			$table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
			$table->integer('stage_id')->unsigned()->index();
			$table->foreign('stage_id')->references('id')->on('stages');
			$table->integer('percent_complete');
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
		Schema::drop('project_stage');
	}

}
