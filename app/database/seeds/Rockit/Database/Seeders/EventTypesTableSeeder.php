<?php

namespace Rockit\Database\Seeders;

use \DB,
    Rockit\Models\EventType;

//Event_types
class EventTypesTableSeeder extends \Seeder {

    public function run() {
        DB::table('event_types')->delete();

        EventType::create(array('id' => '3', 'name_de' => 'Concert'));

        EventType::create(array('id' => '1', 'name_de' => 'Dance lesson'));

        EventType::create(array('id' => '2', 'name_de' => 'One man show'));
    }

}
