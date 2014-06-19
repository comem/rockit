<?php

use Rockit\Resource;

//resources
 class ResourcesTableSeeder extends Seeder {

     public function run()
     {
         DB::table('resources')->delete();

         Resource::create(array('method' => 'get',
                                    'controller' => '/api/v1/welcome'));
     }
 }

