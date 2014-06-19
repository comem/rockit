<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSkillsTable extends Migration {

	public function up()
	{
		Schema::create('skills', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name_de', 200);
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('skills');
	}
}