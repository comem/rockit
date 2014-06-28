<?php

use Rockit\Printing;
use Rockit\PrintingType;
use Rockit\Event;

//printings
 class PrintingsTableSeeder extends Seeder {

     public function run()
     {
         $printingtype = PrintingType::all();
         $event = Event::all();

         DB::statement('SET FOREIGN_KEY_CHECKS = 0');
         DB::table('printings')->delete();

         Printing::create(array('source' => 'printings/die_band2.pdf',
                                 'nb_copies'=>'30',
                                 'nb_copies_surplus'=>'40',
                                 'event_id' => $event[0]->id,
                                 'printing_type_id' => $printingtype[0]->id));
         
         Printing::create(array('source' => 'printings/die_band.pdf',
                                 'nb_copies'=>'20',
                                 'nb_copies_surplus'=>'1',
                                 'event_id' => $event[2]->id,
                                 'printing_type_id' => $printingtype[1]->id));
         
         Printing::create(array('source' => 'printings/ein_supporter.pdf',
                                 'nb_copies'=>'20',
                                 'nb_copies_surplus'=>'4',
                                 'event_id' => $event[2]->id,
                                 'printing_type_id' => $printingtype[2]->id));
         
         Printing::create(array('source' => 'printings/slsamia.pdf',
                                 'nb_copies'=>'8',
                                 'nb_copies_surplus'=>'8',
                                 'event_id' =>'4',
                                 'printing_type_id' => '4'));
         
         Printing::create(array('source' => 'printings/salsamia2.pdf',
                                 'nb_copies'=>'10',
                                 'nb_copies_surplus'=>'4',
                                 'event_id' => '4',
                                 'printing_type_id' => '1'));
         
         Printing::create(array('source' => 'printings/unser_Flyer.pdf',
                                 'nb_copies'=>'8',
                                 'nb_copies_surplus'=>'4',
                                 'event_id' => '5',
                                 'printing_type_id' => '4'));
         
         Printing::create(array('source' => 'printings/unserPlkart.pdf',
                                 'nb_copies'=>'10',
                                 'nb_copies_surplus'=>'4',
                                 'event_id' =>'5',
                                 'printing_type_id' => '1'));
         
         Printing::create(array('source' => 'printings/bluedög.philipp.1.pdf',
                                 'nb_copies'=>'8',
                                 'nb_copies_surplus'=>'0',
                                 'event_id' => '6',
                                 'printing_type_id' => '4'));
         
         Printing::create(array('source' => 'printings/bluedög.philipp.2.pdf',
                                 'nb_copies'=>'10',
                                 'nb_copies_surplus'=>'0',
                                 'event_id' => '6',
                                 'printing_type_id' => '1'));
         
        Printing::create(array('source' => 'printings/konsi-flyer.pdf',
                                 'nb_copies'=>'8',
                                 'nb_copies_surplus'=>'0',
                                 'event_id' => '7',
                                 'printing_type_id' => '4'));
         
         Printing::create(array('source' => 'printings/konsi-plakart.pdf',
                                 'nb_copies'=>'10',
                                 'nb_copies_surplus'=>'0',
                                 'event_id' => '7',
                                 'printing_type_id' => '1'));
         
         Printing::create(array('source' => 'printings/pigeon.dox',
                                 'nb_copies'=>'8',
                                 'nb_copies_surplus'=>'0',
                                 'event_id' => '8',
                                 'printing_type_id' => '4'));
         
         Printing::create(array('source' => 'printings/pigeonpigeon.docx',
                                 'nb_copies'=>'10',
                                 'nb_copies_surplus'=>'0',
                                 'event_id' => '8',
                                 'printing_type_id' => '1'));
         
         
         
     }
 }

