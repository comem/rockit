<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStaffsTable extends Migration {

	public function up()
	{
		Schema::create('staffs', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('member_id')->unsigned();
			$table->integer('event_id')->unsigned();
			$table->integer('skill_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('staffs');
	}
}