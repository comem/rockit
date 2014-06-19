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
    }
}

