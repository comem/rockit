<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLinksTable extends Migration {

	public function up()
	{
		Schema::create('links', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('artist_id')->unsigned();
			$table->string('url', 400);
			$table->string('name_de', 200);
			$table->string('title_de', 50)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('links');
	}
}