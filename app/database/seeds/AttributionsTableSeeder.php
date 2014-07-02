<?php

use Rockit\Models\Attribution,
    Rockit\Models\Equipment,
    Rockit\Models\Event;

//attributions
class AttributionsTableSeeder extends Seeder {

    public function run() {
        $equipment = Equipment::all();
        $event = Event::all();

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('attributions')->delete();

        Attribution::create(array('cost' => '0',
            'quantity' => '5',
            'event_id' => $event[0]->id,
            'equipment_id' => $equipment[0]->id));


        Attribution::create(array('cost' => '0',
            'quantity' => '5',
            'event_id' => $event[2]->id,
            'equipment_id' => $equipment[0]->id));

        Attribution::create(array('cost' => '120.00',
            'quantity' => '1',
            'event_id' => '6',
            'equipment_id' => '1'));
    }

}
