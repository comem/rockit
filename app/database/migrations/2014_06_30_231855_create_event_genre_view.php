<?php

use Illuminate\Database\Migrations\Migration;

class CreateEventGenreView extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        DB::statement('CREATE VIEW event_genre AS '
        . 'SELECT DISTINCT e.id AS event_id, g.id AS genre_id '
        . 'FROM genres g '
        . 'INNER JOIN descriptions d ON d.genre_id = g.id '
        . 'INNER JOIN artists a ON a.id = d.artist_id '
        . 'INNER JOIN performers p ON p.artist_id = a.id '
        . 'INNER JOIN events e ON p.event_id = e.id');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::statement('DROP VIEW event_genre');
    }

}
