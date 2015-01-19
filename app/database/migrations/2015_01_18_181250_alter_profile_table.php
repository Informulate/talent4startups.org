<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProfileTable extends Migration 
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('profiles', function(Blueprint $table)
        {
	        $table->dropColumn(array('linked_in', 'meetup'));
	        $table->string( 'youtube' );
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('profiles', function(Blueprint $table)
        {
	        $table->string('linked_in');
	       	$table->string('meetup');
	        $table->dropColumn( 'youtube' );
        });
	}

}
