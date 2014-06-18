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

    }
}

