<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRepresentersTable extends Migration {

	public function up()
	{
		Schema::create('representers', function(Blueprint $table) {
			$table->increments('id');
			$table->string('first_name', 100);
			$table->string('last_name', 200);
			$table->string('email', 300)->nullable();
			$table->string('phone', 30)->nullable();
			$table->string('street', 300)->nullable();
			$table->string('npa', 10)->nullable();
			$table->string('city', 100)->nullable();
                        $table->string('country', 100)->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('representers');
	}
}