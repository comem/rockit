<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('language_id')->unsigned();
			$table->integer('group_id')->unsigned();
			$table->string('email', 300);
			$table->string('first_name', 200);
			$table->string('last_name', 200);
			$table->string('password', 2000);
			$table->timestamp('last_login')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('users');
	}
}