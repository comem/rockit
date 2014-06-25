<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDescriptionsTable extends Migration {

	public function up()
	{
		Schema::create('descriptions', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('genre_id')->unsigned();
			$table->integer('artist_id')->unsigned();
                        $table->unique(array('genre_id', 'artist_id'));
		});
	}

	public function down()
	{
		Schema::drop('descriptions');
	}
}