<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInstrumentsTable extends Migration {

	public function up()
	{
		Schema::create('instruments', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name_de', 50);
		});
	}

	public function down()
	{
		Schema::drop('instruments');
	}
}