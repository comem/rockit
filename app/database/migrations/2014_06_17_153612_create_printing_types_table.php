<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePrintingTypesTable extends Migration {

	public function up()
	{
		Schema::create('printing_types', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name_de', 100);
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('printing_types');
	}
}