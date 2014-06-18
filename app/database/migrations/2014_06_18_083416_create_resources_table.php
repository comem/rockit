<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResourcesTable extends Migration {

	public function up()
	{
		Schema::create('resources', function(Blueprint $table) {
			$table->increments('id');
			$table->string('verb', 20);
			$table->string('url', 150);
			$table->timestamps();
			$table->softDeletes();
			$table->unique( array('verb','url') );

		});
	}

	public function down()
	{
		Schema::drop('resources');
	}
}