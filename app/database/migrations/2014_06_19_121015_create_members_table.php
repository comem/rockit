<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMembersTable extends Migration {

	public function up()
	{
		Schema::create('members', function(Blueprint $table) {
			$table->increments('id');
			$table->string('first_name', 100);
			$table->string('last_name', 200)->nullable();
			$table->string('email', 300)->nullable();
			$table->string('phone', 30)->nullable();
			$table->boolean('is_active');
			$table->timestamps();
			$table->softDeletes();
			$table->string('street', 300);
			$table->string('npa', 10);
			$table->string('city', 100);
			$table->string('country', 100)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('members');
	}
}