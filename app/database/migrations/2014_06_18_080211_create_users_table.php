<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function(Blueprint $table) {
            $table->increments('id');
            $table->string('email', 300);
            $table->string('password');
            $table->string('first_name', 200);
            $table->string('last_name', 200);
            $table->integer('language_id')->unsigned();
            $table->integer('group_id')->unsigned();
            $table->timestamp('last_login')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('users');
    }

}
