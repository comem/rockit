<?php

namespace ResourceSeeders;

use Rockit\Resource;

class OtherMethodSeeder {
    
    public static function seed() {
        Resource::create(array(
            'id' => 98,
            'controller' => 'EventController',
            'method' => 'publish',
        ));
        Resource::create(array(
            'id' => 99,
            'controller' => 'EventController',
            'method' => 'unpublish',
        ));
        Resource::create(array(
            'id' => 100,
            'controller' => 'EventController',
            'method' => 'exportWord',
        ));
        Resource::create(array(
            'id' => 101,
            'controller' => 'EventController',
            'method' => 'exportXML',
        ));
    }
    
}
