<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTicketsTable extends Migration {

	public function up()
	{
		Schema::create('tickets', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('ticket_category_id')->unsigned();
			$table->integer('event_id')->unsigned();
			$table->integer('amount');
			$table->string('comment_de', 200)->nullable();
			$table->integer('quantity_sold')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('tickets');
	}
}