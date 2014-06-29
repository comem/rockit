<?php

use Rockit\Lineup;
use Rockit\Artist;
use Rockit\Musician;
use Rockit\Instrument;

//artists_musicians
class LineupsTableSeeder extends Seeder {

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('lineups')->delete();
        
        $artist = Artist::all();
        $musician = Musician::all();
        $instrument = Instrument::all();

        

        Lineup::create(array('musician_id' => $musician[0]->id,
                                        'artist_id' => $artist[0]->id,
                                        'instrument_id'=> $instrument[0]->id));
        
        Lineup::create(array('musician_id' => $musician[0]->id,
                                        'artist_id' => $artist[0]->id,
                                        'instrument_id'=> $instrument[1]->id));
        
        Lineup::create(array('musician_id' => $musician[0]->id,
                                        'artist_id' => $artist[0]->id,
                                        'instrument_id'=> $instrument[2]->id));
        
        Lineup::create(array('musician_id' => $musician[1]->id,
                                        'artist_id' => $artist[1]->id,
                                        'instrument_id'=> $instrument[1]->id));
        
        Lineup::create(array('musician_id' => $musician[2]->id,
                                        'artist_id' => $artist[1]->id,
                                        'instrument_id'=> $instrument[1]->id));
        
        Lineup::create(array('musician_id' => $musician[3]->id,
                                        'artist_id' => $artist[1]->id,
                                        'instrument_id'=> $instrument[2]->id));
    
        Lineup::create(array('musician_id' => $musician[4]->id,
                                        'artist_id' => $artist[1]->id,
                                        'instrument_id'=> $instrument[3]->id));
        
        Lineup::create(array('musician_id' => '5',
                                        'artist_id' => '6',
                                        'instrument_id'=> '7'));
        
        Lineup::create(array('musician_id' => '5',
                                        'artist_id' => '6',
                                        'instrument_id'=> '1'));
        
        Lineup::create(array('musician_id' => '6',
                                        'artist_id' => '6',
                                        'instrument_id'=> '2'));
        
        Lineup::create(array('musician_id' => '6',
                                        'artist_id' => '6',
                                        'instrument_id'=> '3'));
        
        Lineup::create(array('musician_id' => '7',
                                        'artist_id' => '6',
                                        'instrument_id'=> '4'));
        
        Lineup::create(array('musician_id' => '8',
                                        'artist_id' => '6',
                                        'instrument_id'=> '5'));
    }
}


