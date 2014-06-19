<?php

use Rockit\EventType;

//Event_types
class EventTypesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('event_types')->delete();

        EventType::create(array('name_de' => 'Jazz'));
    }
}
