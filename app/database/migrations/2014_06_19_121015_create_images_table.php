<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImagesTable extends Migration {

	public function up()
	{
		Schema::create('images', function(Blueprint $table) {
			$table->increments('id');
			$table->string('alt_de', 100)->nullable();
			$table->string('caption_de', 200)->nullable();
			$table->string('source', 100)->unique();
			$table->timestamps();
			$table->unsignedInteger('artist_id')->nullable();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('images');
	}
}