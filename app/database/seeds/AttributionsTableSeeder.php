<?php

use Rockit\Attribution;
use Rockit\Equipment;
use Rockit\Event;

//attributions
class AttributionsTableSeeder extends Seeder {

    public function run()
    {
        $equipment = Equipment::all();
        $event = Event::all();

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('attributions')->delete();

        Attribution::create(array(  'cost'=>'0',
                                    'quantity'=>'5' ,
                                    'event_id'=>$event[0]->id ,
                                    'equipment_id'=>$equipment[0]->id));
    }
}
