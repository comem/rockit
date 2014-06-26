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
        Resource::create(array(
            'id' => 102,
            'controller' => 'FilesManager',
            'method' => 'upload',
        ));
        Resource::create(array(
            'id' => 103,
            'controller' => 'FilesManager',
            'method' => 'getImage',
        ));
        Resource::create(array(
            'id' => 104,
            'controller' => 'FilesManager',
            'method' => 'getPrinting',
        ));
        Resource::create(array(
            'id' => 105,
            'controller' => 'FilesManager',
            'method' => 'getContract',
        ));
        Resource::create(array(
            'id' => 106,
            'controller' => 'FilesManager',
            'method' => 'destroy',
        ));
    }
    
}
