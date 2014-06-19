<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOffersTable extends Migration {

	public function up()
	{
		Schema::create('offers', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('gift_id')->unsigned();
			$table->integer('event_id')->unsigned();
			$table->integer('quantity');
			$table->integer('cost');
			$table->string('comment_de', 200)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('offers');
	}
}