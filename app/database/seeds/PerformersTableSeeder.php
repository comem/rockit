<?php

use Rockit\Performer;
use Rockit\Event;
use Rockit\Artist;

//performers
class PerformersTableSeeder extends Seeder {

    public function run()
    {
        $event = Event::all();
        $artist = Artist::all();

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('performers')->delete();

        Performer::create(array('artist_id' => $artist[0]->id,
                                'event_id'=> $event[0]->id,
                                'order' => '0',
                                'is_support' => '0',
                                'artist_hour_of_arrival'=>'18:00:00'));
    }
}

