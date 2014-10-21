<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSkillsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		 DB::table('skills')->insert(array(
	 	'name'=>'non-profie',
	 	'created_at'=>date('Y-m-d H:i:s'),
	 	'updated_at'=>date('Y-m-d H:i:s'),
	 	));
	 	 DB::table('skills')->insert(array(
	 	'name'=>'Mobile-commerce',
	 	'created_at'=>date('Y-m-d H:i:s'),
	 	'updated_at'=>date('Y-m-d H:i:s'),
	 	));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
			DB::table('skills')->where('name',"=","non-profie")->delete();
			DB::table('skills')->where('name',"=","Mobile-commerce")->delete();
	}

}
