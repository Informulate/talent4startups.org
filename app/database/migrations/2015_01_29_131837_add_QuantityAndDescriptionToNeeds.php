<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddQuantityAndDescriptionToNeeds extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('needs', function(Blueprint $table)
		{
            $table->enum('commitment', array('full-time', 'part-time'))->default('part-time');
            $table->text('description')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('needs', function(Blueprint $table)
		{
            $table->dropColumn(array('commitment', 'description'));
		});
	}

}
