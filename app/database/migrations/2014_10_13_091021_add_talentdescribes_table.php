<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTalentdescribesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	 DB::table('talentdescribes')->insert(array(
	 	'name'=>'Developer',
	 	'created_at'=>date('Y-m-d H:i:s'),
	 	'updated_at'=>date('Y-m-d H:i:s'),
	 	));
	  DB::table('talentdescribes')->insert(array(
	 	'name'=>'Designer',
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
			DB::table('talentdescribes')->where('name',"=","Developer")->delete();
			DB::table('talentdescribes')->where('name',"=","Designer")->delete();
	}

}
