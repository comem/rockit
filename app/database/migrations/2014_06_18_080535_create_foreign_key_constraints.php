<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeyConstraints extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        // Users
        Schema::table('users', function(Blueprint $table) {
            $table->foreign('language_id')->references('id')->on('languages')
            ->onDelete('no action')
            ->onUpdate('no action');
            $table->foreign('group_id')->references('id')->on('groups')
            ->onDelete('no action')
            ->onUpdate('no action');
        });

        // Groups
        Schema::table('groups', function(Blueprint $table) {
            $table->foreign('group_id')->references('id')->on('groups')
            ->onDelete('no action')
            ->onUpdate('no action');
        });

        // GroupResource
        Schema::table('group_resource', function(Blueprint $table) {
            $table->foreign('group_id')->references('id')->on('groups')
            ->onDelete('no action')
            ->onUpdate('no action');
            $table->foreign('resource_id')->references('id')->on('resources')
            ->onDelete('no action')
            ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        // Users
        Schema::table('users', function(Blueprint $table) {
            $table->dropForeign('users_language_id_foreign');
            $table->dropForeign('users_group_id_foreign');
        });

        // Groups
        Schema::table('groups', function(Blueprint $table) {
            $table->dropForeign('groups_group_id_foreign');
        });

        // GroupResource
        Schema::table('group_resource', function(Blueprint $table) {
            $table->dropForeign('group_resource_group_id_foreign');
        });
        Schema::table('group_resource', function(Blueprint $table) {
            $table->dropForeign('group_resource_resource_id_foreign');
        });
    }

}
