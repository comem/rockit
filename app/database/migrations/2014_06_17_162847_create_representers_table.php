<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRepresentersTable extends Migration {

	public function up()
	{
		Schema::create('representers', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('first_name', 100);
			$table->string('last_name', 100);
			$table->string('email', 200)->nullable();
			$table->string('phone', 20)->nullable();
			$table->string('street', 200)->nullable();
			$table->string('npa', 20)->nullable();
			$table->string('city', 200)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('representers');
	}
}