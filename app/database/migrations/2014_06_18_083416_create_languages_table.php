<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLanguagesTable extends Migration {

	public function up()
	{
		Schema::create('languages', function(Blueprint $table) {
			$table->increments('id');
			$table->string('locale', 8);
			$table->string('name_de', 100);
		});
	}

	public function down()
	{
		Schema::drop('languages');
	}
}