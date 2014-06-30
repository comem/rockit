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
                            'published_at'=> '2014-06-02 14:16:23',
                            'image_id'=> $image[0]->id,
                            'event_type_id'=> '1',
                            'representer_id' => $representer[0]->id,
                            'title_de'=> 'Salsa-Tanz & Bar mit der Tanzschule Salsa Namà',
                            'nb_meal'=>'0',
                            'nb_vegan_meal'=>'0',
                            'nb_places'=>'180',
                            'followed_by_private'=>'0',
                            'notes_de'=>'',
                            'meal_notes'=>'Sandwiches zum verkauf vorbereiten',
                            'description_de'=> '17.30 - 18.30 Pre-Party Workshop /n 18.30 - 22.00 Party-Time mit DJ Que rico',
                            ));
        
        Event::create(array(
                            'id'=>'3',
                            'start_date_hour' => '2014-07-07 18:00:00',
                            'ending_date_hour' => '2014-07-08 01:30:00',
                            'published_at'=> '2014-06-02 14:17:56',
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
                            'ending_date_hour' => '2014-07-14 21:30:00',
                            'published_at'=> '2014-05-15 18:54:23',
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
                            'ending_date_hour' => '2014-09-05 01:30:00',
                            'opening_doors' => '19:45:00',
                            'image_id'=> '5',
                            'event_type_id'=> '3',
                            'representer_id' => $representer[1]->id,
                            'title_de'=> 'Philipp Bluedög Gerber Band',
                            'nb_meal'=>'14',
                            'nb_vegan_meal'=>'2',
                            'meal_notes' => 'Würden gern eine Fondue oder raclette essen, vermissen Schweizer essen',
                            'nb_places'=>'180',
                            'followed_by_private'=>'0',
                            'notes_de'=>'',
                            ));
        
        Event::create(array('id'=>'7',
                            'start_date_hour' => '2014-09-11 20:30:00',
                            'ending_date_hour' => '2014-09-12 01:30:00',
                            'opening_doors' => '19:45:00',
                            'image_id'=> '6',
                            'event_type_id'=> '3',
                            'representer_id' => $representer[2]->id,
                            'title_de'=> 'Konsi Big Band goes R\'n\'B \n Support: Junior Big Band',
                            'nb_meal'=>'15',
                            'nb_vegan_meal'=>'1',
                            'nb_places'=>'180',
                            'followed_by_private'=>'0',
                            'notes_de'=>'Möchten konfetis werfen',
                            ));
        
        Event::create(array('id'=>'8',
                            'start_date_hour' => '2014-09-13 21:00:00',
                            'ending_date_hour' => '2014-09-14 01:30:00',
                            'opening_doors' => '20:15:00',
                            'image_id'=> '6',
                            'event_type_id'=> '1',
                            'representer_id' => $representer[0]->id,
                            'title_de'=> 'Pigeons on the gate',
                            'nb_meal'=>'15',
                            'nb_vegan_meal'=>'1',
                            'nb_places'=>'180',
                            'followed_by_private'=>'0',
                            'meal_notes'=>'2 mahl ohne fish, un ein mais alergisch',
                            'notes_de'=>'',
                            ));
        
        Event::create(array('id'=>'9',
                            'start_date_hour' => '2014-09-14 11:00:00',
                            'ending_date_hour' => '2014-09-14 14:30:00',
                            'opening_doors' => '10:15:00',
                            'image_id'=> '7',
                            'event_type_id'=> '1',
                            'representer_id' => '4',
                            'title_de'=> '',
                            'nb_meal'=>'4',
                            'nb_vegan_meal'=>'4',
                            'nb_places'=>'180',
                            'followed_by_private'=>'0',
                            'contract_src'=>'',
                            'notes_de'=>'Brauchen 7 mikrofone',
                            ));
        Event::create(array('id'=>'10',
                            'start_date_hour' => '2014-09-18 20:30:00',
                            'ending_date_hour' => '2014-09-19 01:30:00',
                            'opening_doors' => '19:45:00',
                            'image_id'=> '8',
                            'event_type_id'=> '1',
                            'representer_id' => '3',
                            'title_de'=> '',
                            'nb_meal'=>'1',
                            'nb_vegan_meal'=>'5',
                            'nb_places'=>'180',
                            'followed_by_private'=>'1',
                            'meal_notes' => 'Möchten kein brocoli, und kein geflügel aus Asia, und kein pfeffer, lieber auch ohne salz, und nicht zu hart zu kauhen',
//                            'contract_src'=>'',
                            'notes_de'=>'',
                            ));
        
        Event::create(array('id'=>'11',
                            'start_date_hour' => '2014-09-20 21:00:00',
                            'ending_date_hour' => '2014-09-21 01:30:00',
                            'opening_doors' => '20:15:00',
                            'image_id'=> '9',
                            'event_type_id'=> '1',
//                            'representer_id' => '',
                            'title_de'=> 'Andy Trinkler & Border Affair - CD Taufe',
                            'nb_meal'=>'3',
                            'nb_vegan_meal'=>'1',
                            'nb_places'=>'180',
                            'followed_by_private'=>'0',
//                            'contract_src'=>'',
                            'notes_de'=>'',
                            ));
        
        Event::create(array('id'=>'12',
                            'start_date_hour' => '2014-06-26 21:00:00',
                            'ending_date_hour' => '2014-06-27 01:30:00',
                            'opening_doors' => '20:15:00',
                            'published_at'=> '2014-04-13 09:31:42',
                            'image_id'=> '10',
                            'event_type_id'=> '1',
                            'representer_id' => '5',
                            'title_de'=> '',
                            'nb_meal'=>'5',
                            'nb_vegan_meal'=>'0',
                            'nb_places'=>'180',
                            'followed_by_private'=>'0',
//                            'contract_src'=>'',
                            'notes_de'=>'Mussen am flughafen abgeholt werden am 26 14h30',
                            ));
        
        Event::create(array('id'=>'13',
                            'start_date_hour' => '2014-09-28 18:30:00',
                            'ending_date_hour' => '2014-09-29 22:00:00',
                            'opening_doors' => '17:00:00',
                            'image_id'=> '11',
                            'event_type_id'=> '1',
                            'representer_id' => $representer[0]->id,
                            'title_de'=> 'Salsa-Tanz & Bar mit der Tanzschule Salsa Namà',
                            'nb_meal'=>'0',
                            'nb_vegan_meal'=>'0',
                            'nb_places'=>'180',
                            'followed_by_private'=>'0',
//                            'contract_src'=>'',
                            'notes_de'=>'',
                            'meal_notes'=>'Sandwiches zum verkauf vorbereiten',
                            'description_de' => '17.30 - 18.30 Pre-Party Workshop /n 18.30 - 22.00 Party-Time mit DJ Que rico',
                            ));
        
        Event::create(array('id'=>'14',
                            'start_date_hour' => '2014-06-05 20:30:00',
                            'ending_date_hour' => '2014-06-05 23:45:00',
                            'opening_doors' => '19:45:00',
                            'published_at'=> '2014-04-13 09:21:02',
                            'image_id'=> '12',
                            'event_type_id'=> '13',
                            'representer_id' => '0',
                            'title_de'=> '',
                            'nb_meal'=>'0',
                            'nb_vegan_meal'=>'0',
                            'nb_places'=>'180',
                            'followed_by_private'=>'0',
//                            'contract_src'=>'',
                            'notes_de'=>'',
                            ));

    }
}

