<?php

namespace Rockit\Database\Seeders;

use \DB,
    Rockit\Models\Sharing,
    Rockit\Models\Platform,
    Rockit\Models\Event;

//sharings
class SharingsTableSeeder extends \Seeder {

    public function run() {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('sharings')->delete();

        $platform = Platform::all();
        $event = Event::all();

        Sharing::create(array('platform_id' => $platform[0]->id,
            'event_id' => $event[0]->id,
            'url' => 'http://facebook.com/meinSuperEvent',
            'external_id' => 'abb99938',
        ));

        Sharing::create(array('platform_id' => $platform[0]->id,
            'event_id' => $event[1]->id,
            'url' => 'http://facebook.com/SuperDienst-tag',
            'external_id' => '234756862a',
        ));

        Sharing::create(array('platform_id' => $platform[0]->id,
            'event_id' => $event[2]->id,
            'url' => 'http://facebook.com/Freytag-schokoladegesponosort',
            'external_id' => '234756862a',
        ));
    }

}
