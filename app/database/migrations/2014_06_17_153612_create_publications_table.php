<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePublicationsTable extends Migration {

	public function up()
	{
		Schema::create('publications', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('platform_id')->unsigned();
			$table->integer('event_id')->unsigned();
			$table->string('url', 2000);
			$table->timestamps();
			$table->string('external_id');
			$table->text('external_infos')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('publications');
	}
}