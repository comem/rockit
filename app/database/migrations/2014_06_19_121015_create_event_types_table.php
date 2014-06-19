<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventTypesTable extends Migration {

	public function up()
	{
		Schema::create('event_types', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name_de', 100);
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('event_types');
	}
}