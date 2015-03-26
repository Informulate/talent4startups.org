<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkillStartupTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('skill_startup', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('startup_id')->unsigned()->index();
			$table->foreign('startup_id')->references('id')->on('startups')->onDelete('cascade');
			$table->integer('skill_id')->unsigned()->index();
			$table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('skill_startup');
	}

}
