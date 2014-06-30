<?php

use Rockit\Genre;

// Genres
class GenresTableSeeder extends Seeder {

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('genres')->delete();
        
        Genre::create(array('id'=>'1','name_de' => 'Balkan'));
        
        Genre::create(array('id'=>'2','name_de' => 'Französiche chansons'));
        
        Genre::create(array('id'=>'3','name_de' => 'finest live reggae'));
        
        Genre::create(array('id'=>'4','name_de' => 'hip-hop'));
        
        Genre::create(array('id'=>'5','name_de' => "'r'n'b'"));
        
        Genre::create(array('id'=>'6','name_de' => 'Salsa'));
        
        Genre::create(array('id'=>'7','name_de' => 'Bluesrock'));
        
        Genre::create(array('id'=>'8','name_de' => 'Irish Folk'));
        
        Genre::create(array('id'=>'9','name_de' => 'Latin'));
        
        Genre::create(array('id'=>'11','name_de' => 'New Orleans'));
        
        Genre::create(array('id'=>'12','name_de' => 'Blues'));
        
        Genre::create(array('id'=>'13','name_de' => 'Chicago Jazz 1920er Jahre'));
        
        Genre::create(array('id'=>'14','name_de' => 'Bluespopjazz'));
        
        Genre::create(array('id'=>'15','name_de' => 'Pop- rock'));
        
        Genre::create(array('id'=>'16','name_de' => 'Ska'));
        
        Genre::create(array('id'=>'17','name_de' => 'Rocksteady'));
        
        Genre::create(array('id'=>'18','name_de' => 'Roots Reggae & Dub'));
        
        Genre::create(array('id'=>'19','name_de' => 'New Roots Reggae'));
        
        Genre::create(array('id'=>'20','name_de' => 'Psychedelic Soul'));
        
        Genre::create(array('id'=>'21','name_de' => 'Funk'));
        
        Genre::create(array('id'=>'22','name_de' => 'Jazz'));
        
        Genre::create(array('id'=>'23','name_de' => 'Singer'));
        
        Genre::create(array('id'=>'24','name_de' => 'Songwriter'));
        
        Genre::create(array('id'=>'25','name_de' => 'Berner Mundartrock'));
        
        Genre::create(array('id'=>'26','name_de' => 'Acoustic Rock'));
        
        Genre::create(array('id'=>'27','name_de' => 'Pop'));
        
        
    }
}
