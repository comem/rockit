<?php

use Rockit\Genre;

// Genres
class GenresTableSeeder extends Seeder {

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('genres')->delete();

        Genre::create(array('name_de' => 'Pop- rock'));
        
        Genre::create(array('name_de' => 'Balkan'));
        
        Genre::create(array('name_de' => 'Französiche chansons'));
        
        Genre::create(array('name_de' => 'finest live reggae'));
        
        Genre::create(array('name_de' => 'hip-hop'));
        
        Genre::create(array('name_de' => "'r'n'b'"));
        
        Genre::create(array('name_de' => 'mundart'));
        
    }
}
