<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('tags')->insert(array(
	 	'name'=>'laravel',
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
		DB::table('tags')->where('name',"=","laravel")->delete();
	}

}
