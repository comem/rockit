<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResourcesTable extends Migration {

	public function up()
	{
		Schema::create('resources', function(Blueprint $table) {
			$table->increments('id');
			$table->string('method', 250);
			$table->string('controller', 250);
			$table->timestamps();
			$table->softDeletes();
			$table->unique(array('method', 'controller'));
		});
	}

	public function down()
	{
		Schema::drop('resources');
	}
}