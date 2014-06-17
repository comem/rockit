<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArtistsMusiciansTable extends Migration {

	public function up()
	{
		Schema::create('artists_musicians', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('musician_id')->unsigned();
			$table->integer('artist_id')->unsigned();
			$table->integer('instrument_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('artists_musicians');
	}
}