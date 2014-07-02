<?php

use Rockit\Models\Performer;
use Rockit\Models\Event;
use Rockit\Models\Artist;

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
        
        Performer::create(array('artist_id' => $artist[1]->id,
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
    
        Performer::create(array('artist_id' => 8,
                                'event_id'=> 6,
                                'order' => '1',
                                'is_support' => '0',
                                'artist_hour_of_arrival'=>'2014-09-05 16:00:00'));
        
        Performer::create(array('artist_id' => 5,
                                'event_id'=> 7,
                                'order' => '1',
                                'is_support' => '0',
                                'artist_hour_of_arrival'=>'2014-09-05 17:00:00'));
        
         Performer::create(array('artist_id' => 6,
                                'event_id'=> 7,
                                'order' => '2',
                                'is_support' => '0',
                                'artist_hour_of_arrival'=>'2014-09-05 17:00:00'));
        
        Performer::create(array('artist_id' => 7,
                                'event_id'=> 8,
                                'order' => '1',
                                'is_support' => '0',
                                'artist_hour_of_arrival'=>'2014-09-05 17:00:00'));
        
        Performer::create(array('artist_id' => 3,
                                'event_id'=> 4,
                                'order' => '1',
                                'is_support' => '0',
                                'artist_hour_of_arrival'=>'2014-09-05 16:30:00'));

        Performer::create(array('artist_id' => 4,
                                'event_id'=> 5,
                                'order' => '1',
                                'is_support' => '0',
                                'artist_hour_of_arrival'=>'2014-09-05 17:45:00'));
    }

}

