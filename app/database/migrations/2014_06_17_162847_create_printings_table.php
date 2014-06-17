<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePrintingsTable extends Migration {

	public function up()
	{
		Schema::create('printings', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('printing_type_id')->unsigned();
			$table->integer('event_id')->unsigned();
			$table->string('source', 100);
			$table->integer('nb_copies');
			$table->integer('nb_copies_surplus');
		});
	}

	public function down()
	{
		Schema::drop('printings');
	}
}