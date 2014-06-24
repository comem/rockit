<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAttributionsTable extends Migration {

	public function up()
	{
		Schema::create('attributions', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('equipment_id')->unsigned();
			$table->integer('event_id')->unsigned();
			$table->integer('cost')->nullable();
			$table->integer('quantity')->default(1);
                        $table->unique(array('equipment_id', 'event_id'));
		});
	}

	public function down()
	{
		Schema::drop('attributions');
	}
}