<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTicketCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('ticket_categories', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name_de', 50);
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('ticket_categories');
	}
}