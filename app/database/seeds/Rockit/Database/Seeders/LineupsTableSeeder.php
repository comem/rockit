<?php

namespace Rockit\Database\Seeders;

use \DB,
    Rockit\Models\Lineup,
    Rockit\Models\Artist,
    Rockit\Models\Musician,
    Rockit\Models\Instrument;

//artists_musicians
class LineupsTableSeeder extends \Seeder {

    public function run() {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('lineups')->delete();

        $artist = Artist::all();
        $musician = Musician::all();
        $instrument = Instrument::all();



        Lineup::create(array('musician_id' => $musician[0]->id,
            'artist_id' => $artist[0]->id,
            'instrument_id' => $instrument[0]->id));

        Lineup::create(array('musician_id' => $musician[0]->id,
            'artist_id' => $artist[0]->id,
            'instrument_id' => $instrument[1]->id));

        Lineup::create(array('musician_id' => $musician[0]->id,
            'artist_id' => $artist[0]->id,
            'instrument_id' => $instrument[2]->id));

        Lineup::create(array('musician_id' => $musician[1]->id,
            'artist_id' => $artist[1]->id,
            'instrument_id' => $instrument[1]->id));

        Lineup::create(array('musician_id' => $musician[2]->id,
            'artist_id' => $artist[1]->id,
            'instrument_id' => $instrument[1]->id));

        Lineup::create(array('musician_id' => $musician[3]->id,
            'artist_id' => $artist[1]->id,
            'instrument_id' => $instrument[2]->id));

        Lineup::create(array('musician_id' => $musician[4]->id,
            'artist_id' => $artist[1]->id,
            'instrument_id' => $instrument[3]->id));

        Lineup::create(array('musician_id' => '5',
            'artist_id' => '6',
            'instrument_id' => '7'));

        Lineup::create(array('musician_id' => '5',
            'artist_id' => '6',
            'instrument_id' => '1'));

        Lineup::create(array('musician_id' => '6',
            'artist_id' => '6',
            'instrument_id' => '2'));

        Lineup::create(array('musician_id' => '6',
            'artist_id' => '6',
            'instrument_id' => '3'));

        Lineup::create(array('musician_id' => '7',
            'artist_id' => '6',
            'instrument_id' => '4'));

        Lineup::create(array('musician_id' => '8',
            'artist_id' => '6',
            'instrument_id' => '5'));

        Lineup::create(array('musician_id' => '23',
            'artist_id' => '7',
            'instrument_id' => '7'));

        Lineup::create(array('musician_id' => '23',
            'artist_id' => '7',
            'instrument_id' => '8'));

        Lineup::create(array('musician_id' => '23',
            'artist_id' => '7',
            'instrument_id' => '9'));

        Lineup::create(array('musician_id' => '24',
            'artist_id' => '7',
            'instrument_id' => '7'));

        Lineup::create(array('musician_id' => '24',
            'artist_id' => '7',
            'instrument_id' => '10'));

        Lineup::create(array('musician_id' => '24',
            'artist_id' => '7',
            'instrument_id' => '11'));

        Lineup::create(array('musician_id' => '24',
            'artist_id' => '7',
            'instrument_id' => '9'));

        Lineup::create(array('musician_id' => '25',
            'artist_id' => '7',
            'instrument_id' => '12'));

        Lineup::create(array('musician_id' => '25',
            'artist_id' => '7',
            'instrument_id' => '13'));

        Lineup::create(array('musician_id' => '26',
            'artist_id' => '7',
            'instrument_id' => '2'));

        Lineup::create(array('musician_id' => '26',
            'artist_id' => '7',
            'instrument_id' => '13'));

        Lineup::create(array('musician_id' => '27',
            'artist_id' => '7',
            'instrument_id' => '4'));

        Lineup::create(array('musician_id' => '27',
            'artist_id' => '7',
            'instrument_id' => '14'));

        Lineup::create(array('musician_id' => '28',
            'artist_id' => '9',
            'instrument_id' => '15'));

        Lineup::create(array('musician_id' => '28',
            'artist_id' => '9',
            'instrument_id' => '16'));

        Lineup::create(array('musician_id' => '28',
            'artist_id' => '9',
            'instrument_id' => '1'));

        Lineup::create(array('musician_id' => '29',
            'artist_id' => '9',
            'instrument_id' => '17'));

        Lineup::create(array('musician_id' => '29',
            'artist_id' => '9',
            'instrument_id' => '18'));

        Lineup::create(array('musician_id' => '30',
            'artist_id' => '9',
            'instrument_id' => '19'));

        Lineup::create(array('musician_id' => '31',
            'artist_id' => '9',
            'instrument_id' => '20'));

        Lineup::create(array('musician_id' => '32',
            'artist_id' => '9',
            'instrument_id' => '21'));

        Lineup::create(array('musician_id' => '33',
            'artist_id' => '9',
            'instrument_id' => '4'));

        Lineup::create(array('musician_id' => '34',
            'artist_id' => '10',
            'instrument_id' => '1'));

        Lineup::create(array('musician_id' => '35',
            'artist_id' => '10',
            'instrument_id' => '4'));

        Lineup::create(array('musician_id' => '38',
            'artist_id' => '10',
            'instrument_id' => '22'));

        Lineup::create(array('musician_id' => '38',
            'artist_id' => '10',
            'instrument_id' => '20'));

        Lineup::create(array('musician_id' => '36',
            'artist_id' => '10',
            'instrument_id' => '2'));

        Lineup::create(array('musician_id' => '37',
            'artist_id' => '10',
            'instrument_id' => '7'));
    }

}
