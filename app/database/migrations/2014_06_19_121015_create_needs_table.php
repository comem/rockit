<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNeedsTable extends Migration {

	public function up()
	{
		Schema::create('needs', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('skill_id')->unsigned();
			$table->integer('event_id')->unsigned();
			$table->integer('nb_people');
		});
	}

	public function down()
	{
		Schema::drop('needs');
	}
}