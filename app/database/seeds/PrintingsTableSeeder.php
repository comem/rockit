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

         Printing::create(array('source' => 'die band',
                                 'nb_copies'=>'3000',
                                 'nb_copies_surplus'=>'400',
                                 'event_id' => $event[0]->id,
                                 'printing_type_id' => $printingtype[0]->id));
     }
 }

