<?php

namespace Rockit\Database\Seeders;

use \DB,
    Rockit\Models\Link,
    Rockit\Models\Artist;

//links
class LinksTableSeeder extends \Seeder {

    public function run() {
        DB::table('links')->delete();

        $artist = Artist::all();

        Link::create(array('id' => '1',
            'url' => "www.totensocken.at",
            'name_de' => 'Östereichiese webseite von die toten Socken',
            'artist_id' => $artist[0]->id,));

        Link::create(array('id' => '2',
            'url' => "www.stoneandrollcomparative.eu",
            'name_de' => 'Hier geht es über Rock, die sich drehen',
            'artist_id' => $artist[1]->id,));

        Link::create(array('id' => '3',
            'url' => "www.hardlikearock.ch",
            'name_de' => 'kein komentar',
            'artist_id' => $artist[1]->id,));

        Link::create(array('id' => '4',
            'url' => "www.salsanama.ch",
            'name_de' => 'kein komentar',
            'artist_id' => 3,));

        Link::create(array('id' => '5',
            'url' => "www.ninos-jugando.ch",
            'name_de' => 'kein komentar',
            'artist_id' => $artist[4]->id,));

        Link::create(array('id' => '6',
            'url' => "www.philippgerber.com",
            'name_de' => 'kein komentar',
            'artist_id' => $artist[6]->id,));

        Link::create(array('id' => '7',
            'url' => "www.totensocken.eu",
            'name_de' => 'webseite von die toten Socken',
            'artist_id' => $artist[0]->id,));

        Link::create(array('id' => '8',
            'url' => "www.pigeononthegate.com",
            'name_de' => 'Pigeon on the gate webseite',
            'artist_id' => 7,));

        Link::create(array('id' => '9',
            'url' => "www.m3x.ch/artist/manuhartmanband",
            'name_de' => 'Manu webseite',
            'artist_id' => 10,));

        Link::create(array('id' => 10,
            'url' => "www.spanonline.ch",
            'name_de' => 'Span div tr',
            'artist_id' => 12,));

        Link::create(array('id' => '11',
            'url' => "www.sarahchaksad.ch",
            'name_de' => 'Sarah goes online',
            'artist_id' => 13,));
    }

}
