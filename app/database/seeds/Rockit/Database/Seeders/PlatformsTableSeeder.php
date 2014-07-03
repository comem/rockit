<?php

namespace Rockit\Database\Seeders;

use \DB,
    Rockit\Models\Platform;

//Platforms		
class PlatformsTableSeeder extends \Seeder {

    public function run() {
        DB::table('platforms')->delete();

        Platform::create(['name' => 'facebook',
            'client_id' => '47e0f75cfb5fbac37daad408acc872f9',
            'client_secret' => '643ecaf09a71e3f9ff9cfb0062cc9079',
            'api_infos' => json_encode([
                'appkey' => '702257233173597',
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
