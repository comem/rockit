<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFulfillmentsTable extends Migration {

	public function up()
	{
		Schema::create('fulfillments', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('skill_id')->unsigned();
			$table->integer('member_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('fulfillments');
	}
}