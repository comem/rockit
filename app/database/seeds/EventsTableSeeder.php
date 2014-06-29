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
        
        Event::create(array('id'=>'4',
                            'start_date_hour' => '2014-08-24 17:30:00',
                            'ending_date_hour' => '2014-08-24 22:00:00',
                            'opening_doors' => '17:00:00',
                            'image_id'=> $image[0]->id,
                            'event_type_id'=> '1',
                            'representer_id' => $representer[0]->id,
                            'title_de'=> 'Salsa-Tanz & Bar mit der Tanzschule Salsa Namà',
                            'nb_meal'=>'12',
                            'nb_vegan_meal'=>'0',
                            'nb_places'=>'180',
                            'followed_by_private'=>'0',
                            'notes_de'=>'',
                            'description_de'=> '17.30 - 18.30 Pre-Party Workshop /n 18.30 - 22.00 Party-Time mit DJ Que rico',
                            ));
        
        Event::create(array(
                            'id'=>'3',
                            'start_date_hour' => '2014-07-07 18:00:00',
                            'image_id'=> $image[1]->id,
                            'event_type_id'=> $eventtype[0]->id,
                            'representer_id' => $representer[1]->id,
                            'event_type_id'=> '3',
                            'title_de'=> 'Eröffnung party',
                            'nb_meal'=>'60',
                            'nb_vegan_meal'=>'21',
                            'nb_places'=>'180',
                            'followed_by_private'=>'0',
                            ));
        
        Event::create(array(
                            'id'=>'2',
                            'start_date_hour' => '2014-07-14 18:00:00',
                            'image_id'=> $image[3]->id,
                            'event_type_id'=> $eventtype[2]->id,
                            'representer_id' => $representer[1]->id,
                            'event_type_id'=> '3',
                            'title_de'=> '',
                            'nb_meal'=>'21',
                            'nb_vegan_meal'=>'4',
                            'nb_places'=>'180',
                            'followed_by_private'=>'1',
                            ));
        
        Event::create(array('id'=>'5',
                            'start_date_hour' => '2014-08-29 17:30:00',
                            'ending_date_hour' => '2014-08-29 22:00:00',
                            'opening_doors' => '17:00:00',
                            'image_id'=> $image[0]->id,
                            'event_type_id'=> '3',
                            'representer_id' => $representer[0]->id,
                            'title_de'=> 'Benefizkonzert Dar Vida',
                            'nb_meal'=>'14',
                            'nb_vegan_meal'=>'2',
                            'nb_places'=>'180',
                            'followed_by_private'=>'0',
                            'notes_de'=>'Brauchen 3 Taschenlampen',
                            ));
        
        Event::create(array('id'=>'6',
                            'start_date_hour' => '2014-09-05 20:30:00',
                            'opening_doors' => '19:45:00',
                            'image_id'=> '5',
                            'event_type_id'=> '3',
                            'representer_id' => $representer[1]->id,
                            'title_de'=> 'Philipp Bluedög Gerber Band',
                            'nb_meal'=>'14',
                            'nb_vegan_meal'=>'2',
                            'nb_places'=>'180',
                            'followed_by_private'=>'0',
                            'notes_de'=>'',
                            ));
        
        Event::create(array('id'=>'7',
                            'start_date_hour' => '2014-09-11 20:30:00',
                            'opening_doors' => '19:45:00',
                            'image_id'=> '6',
                            'event_type_id'=> '3',
                            'representer_id' => $representer[2]->id,
                            'title_de'=> 'Konsi Big Band goes R\'n\'B \n Support: Junior Big Band',
                            'nb_meal'=>'15',
                            'nb_vegan_meal'=>'1',
                            'nb_places'=>'180',
                            'followed_by_private'=>'0',
                            'notes_de'=>'',
                            ));
        
        Event::create(array('id'=>'8',
                            'start_date_hour' => '2014-08-13 21:00:00',
                            'opening_doors' => '20:15:00',
                            'image_id'=> '6',
                            'event_type_id'=> '1',
                            'representer_id' => $representer[0]->id,
                            'title_de'=> 'Pigeons on the gate',
                            'nb_meal'=>'15',
                            'nb_vegan_meal'=>'1',
                            'nb_places'=>'180',
                            'followed_by_private'=>'0',
                            'notes_de'=>'',
                            ));
    }
}

