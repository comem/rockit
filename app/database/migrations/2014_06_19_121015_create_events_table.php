<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventsTable extends Migration {

	public function up()
	{
		Schema::create('events', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamp('start_date_hour')->unique();
			$table->unsignedInteger('event_type_id');
			$table->unsignedInteger('representer_id')->nullable();
			$table->unsignedInteger('image_id')->nullable();
			$table->timestamp('ending_date_hour');
			$table->time('opening_doors')->nullable();
			$table->string('title_de', 200)->nullable();
            $table->string('description_de')->nullable();
			$table->integer('nb_meal');
			$table->integer('nb_vegans_meal');
			$table->text('meal_notes_de')->nullable();
			$table->string('nb_places')->default(180);
			$table->boolean('followed_by_private')->default(false);
			$table->string('contract_src', 100)->nullable()->unique();
			$table->text('notes_de')->nullable();
			$table->timestamps();
			$table->timestamp('published_at')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('events');
	}
}