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
                                'order' => '1',
                                'is_support' => '0',
                                'artist_hour_of_arrival'=>'2014-08-02 18:00:00'));
        
        Performer::create(array('artist_id' => $artist[0]->id,
                                'event_id'=> $event[0]->id,
                                'order' => '0',
                                'is_support' => '1',
                                'artist_hour_of_arrival'=>'2014-08-02 19:00:00'));
        
        Performer::create(array('artist_id' => $artist[0]->id,
                                'event_id'=> $event[1]->id,
                                'order' => '0',
                                'is_support' => '1',
                                'artist_hour_of_arrival'=>'2014-09-18 17:00:00'));
        
        Performer::create(array('artist_id' => $artist[2]->id,
                                'event_id'=> $event[1]->id,
                                'order' => '1',
                                'is_support' => '0',
                                'artist_hour_of_arrival'=>'2014-09-18 17:00:00'));
}

}

