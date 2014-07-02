<?php

namespace Rockit\Database\Seeders;

use \DB,
    Rockit\Models\Description,
    Rockit\Models\Artist,
    Rockit\Models\Genre;

//artists_genres
class DescriptionTableSeeder extends \Seeder {

    public function run() {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('descriptions')->delete();

        $artist = Artist::all();
        $genre = Genre::all();

        Description::create(array('artist_id' => $artist[0]->id,
            'genre_id' => $genre[0]->id));

        Description::create(array('artist_id' => $artist[1]->id,
            'genre_id' => $genre[2]->id));

        Description::create(array('artist_id' => $artist[2]->id,
            'genre_id' => $genre[3]->id));

        Description::create(array('artist_id' => $artist[2]->id,
            'genre_id' => $genre[4]->id));

        Description::create(array('artist_id' => '3',
            'genre_id' => '6'));

        Description::create(array('artist_id' => '4',
            'genre_id' => '9'));

        Description::create(array('artist_id' => '4',
            'genre_id' => '6'));

        Description::create(array('artist_id' => '8',
            'genre_id' => '7'));

        Description::create(array('artist_id' => '6',
            'genre_id' => '5'));

        Description::create(array('artist_id' => '5',
            'genre_id' => '5'));

        Description::create(array('artist_id' => '7',
            'genre_id' => '8'));

        Description::create(array('artist_id' => '9',
            'genre_id' => '13'));

        Description::create(array('artist_id' => '10',
            'genre_id' => '20'));

        Description::create(array('artist_id' => '10',
            'genre_id' => '21'));

        Description::create(array('artist_id' => '10',
            'genre_id' => '22'));

        Description::create(array('artist_id' => '11',
            'genre_id' => '23'));

        Description::create(array('artist_id' => '11',
            'genre_id' => '24'));

        Description::create(array('artist_id' => '12',
            'genre_id' => '25'));

        Description::create(array('artist_id' => '13',
            'genre_id' => '22'));

        Description::create(array('artist_id' => '14',
            'genre_id' => '26'));

        Description::create(array('artist_id' => '14',
            'genre_id' => '27'));
    }

}
