<?php

use Rockit\Genre;

// Genres
class GenresTableSeeder extends Seeder {

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('genres')->delete();

        Genre::create(array('id'=>'0','name_de' => 'Pop- rock'));
        
        Genre::create(array('id'=>'1','name_de' => 'Balkan'));
        
        Genre::create(array('id'=>'2','name_de' => 'Französiche chansons'));
        
        Genre::create(array('id'=>'3','name_de' => 'finest live reggae'));
        
        Genre::create(array('id'=>'4','name_de' => 'hip-hop'));
        
        Genre::create(array('id'=>'5','name_de' => "'r'n'b'"));
        
        Genre::create(array('id'=>'6','name_de' => 'Salsa'));
        
        Genre::create(array('id'=>'7','name_de' => 'Bluesrock'));
        
        Genre::create(array('id'=>'8','name_de' => 'Irish Folk'));
        
        Genre::create(array('id'=>'9','name_de' => 'Latin'));
    }
}
