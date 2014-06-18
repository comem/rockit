<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourcesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('resources', function(Blueprint $table) {
            $table->increments('id');
            $table->string('controller', 250);
            $table->string('method', 250);
            $table->timestamps();
            $table->softDeletes();
            $table->unique(array('controller', 'method'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('resources');
    }

}
