<?php

namespace Rockit\Database\Seeders;

use \DB,
    Rockit\Models\Platform;

//Platforms		
class PlatformsTableSeeder extends \Seeder {

    public function run() {
        DB::table('platforms')->delete();

        Platform::create(['name' => 'facebook',
            'client_id' => 'b57cef5c98b4a660df50716523f2e88f',
            'client_secret' => '586b37a33c0961629a8cd70f679093bc',
            'api_infos' => json_encode([
                'appkey' => '702199776512676',
                'link' => 'www.mahogany.ch',
                'scope' => ['publish_actions'],
                'place_id' => '193405720709427',
                'redirect_url' => 'http://pingouin.heig-vd.ch/rockit/v1/facebook/redirect',
                'username' => 'Joel Gugger',
            ])
        ]);

        Platform::create(array('name' => 'Event booster'));
    }

}
