<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupRessourceTable extends Migration {

	public function up()
	{
		Schema::create('group_ressource', function(Blueprint $table) {
			$table->integer('group_id')->unsigned();
			$table->integer('ressource_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('group_ressource');
	}
}