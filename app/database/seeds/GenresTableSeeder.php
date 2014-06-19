<?php

use Rockit\Genre;

// Genres
class GenresTableSeeder extends Seeder {

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('genres')->delete();

        Genre::create(array('name_de' => 'rock'));
    }
}
