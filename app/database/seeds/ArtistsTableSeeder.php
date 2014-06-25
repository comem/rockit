<?php

use Rockit\Artist;

// artist
class ArtistsTableSeeder extends Seeder {

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('artists')->delete();

        Artist::create(array('name' => 'Die toten Socken',
                            'short_description_de'=>'Band die nur über kleider singt ',
                            'complete_description_de'=> 'Rock band, die nur über kleider signt und zu populair ist',
                            ));
        
        Artist::create(array('name' => 'Rock family',
                            'short_description_de'=>'This family really do not know aht goes about rock ',
                            'complete_description_de'=> 'Just a crazy family perfomring in the name of the Stein music',
                            ));
        
        Artist::create(array('name' => 'redbulp',
                            'short_description_de'=>'New talent from Belp',
                            'complete_description_de'=> ' A new Singer that know how to sing well',
                            ));
        
       
        
        
    }
}

