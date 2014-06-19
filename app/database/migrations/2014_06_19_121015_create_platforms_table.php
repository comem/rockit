<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlatformsTable extends Migration {

	public function up()
	{
		Schema::create('platforms', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 50);
			$table->string('client_id')->nullable();
			$table->text('client_secret')->nullable();
			$table->text('api_infos')->nullable();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('platforms');
	}
}