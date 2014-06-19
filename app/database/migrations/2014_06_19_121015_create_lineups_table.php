<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLineupsTable extends Migration {

	public function up()
	{
		Schema::create('lineups', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('musician_id')->unsigned();
			$table->integer('artist_id')->unsigned();
			$table->integer('instrument_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('lineups');
	}
}