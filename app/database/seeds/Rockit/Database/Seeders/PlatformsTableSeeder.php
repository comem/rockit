<?php

namespace Rockit\Database\Seeders;

use \DB,
    Rockit\Models\Platform;

//Platforms		
class PlatformsTableSeeder extends \Seeder {

    public function run() {
        DB::table('platforms')->delete();

        Platform::create(['name' => 'facebook',
            'client_id' => '92fdbe1c9900d98d1279e02fe55c5001',
            'client_secret' => 'd381b2204500c4c6c1e8510c303c599d',
            'api_infos' => json_encode([
                'appkey' => '836331943057445',
                'link' => 'www.mahogany.ch',
                'scope' => ['publish_actions'],
                'place_id' => '193405720709427',
                'redirect_url' => 'http://localhost:8000/v1/facebook/redirect',
                'username' => 'Chris Sharkman',
            ])
        ]);

        Platform::create(array('name' => 'Event booster'));
    }

}
