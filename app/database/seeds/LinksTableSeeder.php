<?php

use Rockit\Link;
use Rockit\Artist;

//links
class LinksTableSeeder extends Seeder {

    public function run()
    {
        DB::table('links')->delete();

        $artist = Artist::all();

        Link::create(array('url'=>"www.totensocken.eu",
                            'name_de'=> 'webseite von die toten Socken',
                            'artist_id'=> $artist[0]->id,));
        
        Link::create(array('url'=>"www.totensocken.at",
                            'name_de'=> 'Östereichiese webseite von die toten Socken',
                            'artist_id'=> $artist[0]->id,));
        
        Link::create(array('url'=>"www.stoneandrollcomparative.eu",
                            'name_de'=> 'Hier geht es über Rock, die sich drehen',
                            'artist_id'=> $artist[1]->id,));
        
        Link::create(array('url'=>"www.hardlikearock.ch",
                            'name_de'=> 'kein komentar',
                            'artist_id'=> $artist[1]->id,));

    }
}

