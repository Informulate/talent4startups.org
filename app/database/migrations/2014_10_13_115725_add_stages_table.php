<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	DB::table('stages')->insert(array(
	 	'name'=>'Starting Point',
	 	'created_at'=>date('Y-m-d H:i:s'),
	 	'updated_at'=>date('Y-m-d H:i:s'),
	 	)); 
	DB::table('stages')->insert(array(
	 	'name'=>'Ending Point',
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
			DB::table('stages')->where('name',"=","Starting Point")->delete();
			DB::table('stages')->where('name',"=","laravel")->delete();
	}

}
