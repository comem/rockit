<?php

use Rockit\Event;
use Rockit\EventType;
use Rockit\Image;
use Rockit\Representer;

// event
class EventsTableSeeder extends Seeder {

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('events')->delete();

        $eventtype = EventType::all();
        $image = Image::all();
        $representer = Representer::all();
        
        Event::create(array('start_date_hour' => '2014-07-07 18:00:00',
                            'image_id'=> $image[0]->id,
                            'event_type_id'=> $eventtype[0]->id,
                            'representer_id' => $representer[0]->id,
                            'title_de'=> '',
                            'nb_meal'=>'12',
                            'nb_vegan_meal'=>'0',
                            'nb_places'=>'180',
                            'followed_by_private'=>'0',
                            ));
    }
}

