<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArtistsTable extends Migration {

    public function up() {
        Schema::create('artists', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('short_description_de', 200)->nullable();
            $table->text('complete_description_de')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::drop('artists');
    }

}
