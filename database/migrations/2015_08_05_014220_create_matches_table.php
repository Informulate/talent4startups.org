<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table = Schema::create('matches', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->integer('startup_id')->index();
            $table->string('description');
            $table->integer('weight');
            $table->text('debug');
            $table->boolean('ignored');
            $table->timestamps();

            $table->unique(['user_id', 'startup_id']);
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('matches');
    }
}
