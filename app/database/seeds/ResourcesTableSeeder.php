<?php

use Rockit\Resource;

//resources
 class ResourcesTableSeeder extends Seeder {

     public function run()
     {
         DB::table('resources')->delete();

         Resource::create(array('verb' => 'get',
                                    'url' => '/api/v1/welcome'));
     }
 }

