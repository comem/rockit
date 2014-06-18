<?php

use Rockit\Description;
use Rockit\Artist;
use Rockit\Genre;

//artists_genres
class DescriptionTableSeeder extends Seeder {

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('descriptions')->delete();

        $artist = Artist::all();
        $genre = Genre::all();

        Description::create(array('artist_id' => $artist[0]->id,
                                    'genre_id'=> $genre[0]->id));

    }
}

