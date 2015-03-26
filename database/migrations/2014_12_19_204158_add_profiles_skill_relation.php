<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddProfilesSkillRelation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('profiles', function(Blueprint $table)
		{
			$table->dropColumn('skill');
			$table->integer('skill_id')->after('user_id')->index()->references('id')->on('skills')->onDelete('cascade');
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
			$table->dropForeign('skill');
			$table->dropIndex('skill');
			$table->dropColumn('skill_id');
		});
	}

}
