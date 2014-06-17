<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePerformersTable extends Migration {

	public function up()
	{
		Schema::create('performers', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('artist_id')->unsigned();
			$table->integer('event_id')->unsigned();
			$table->integer('order');
			$table->boolean('is_support');
			$table->timestamp('artist_our_of_arrival');
		});
	}

	public function down()
	{
		Schema::drop('performers');
	}
}