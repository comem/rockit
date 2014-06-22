<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePerformersTable extends Migration {

	public function up()
	{
		Schema::create('performers', function(Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('artist_id');
			$table->unsignedInteger('event_id');
			$table->integer('order');
			$table->boolean('is_support')->default(false);
			$table->timestamp('artist_hour_of_arrival');
		});
	}

	public function down()
	{
		Schema::drop('performers');
	}
}