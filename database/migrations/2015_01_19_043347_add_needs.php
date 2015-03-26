<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddNeeds extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('needs', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('quantity')->default(0)->unsigned();
            $table->integer('skill_id')->unsigned()->nullable()->index();
            $table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
            $table->integer('startup_id')->unsigned()->index();
            $table->foreign('startup_id')->references('id')->on('startups')->onDelete('cascade');
            $table->timestamps();
		});

        Schema::create('need_tag', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('need_id')->unsigned()->index();
            $table->foreign('need_id')->references('id')->on('needs')->onDelete('cascade');
            $table->integer('tag_id')->unsigned()->index();
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('need_tag');
		Schema::drop('needs');
	}

}
