<?php

namespace ResourceSeeders;

use Rockit\Models\Resource;

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
        Resource::create(array(
            'id' => 107,
            'controller' => 'ArtistController',
            'method' => 'illustrate',
        ));
        Resource::create(array(
            'id' => 108,
            'controller' => 'ArtistController',
            'method' => 'desillustrate',
        ));
        Resource::create(array(
            'id' => 109,
            'controller' => 'EventController',
            'method' => 'symbolize',
        ));
        Resource::create(array(
            'id' => 110,
            'controller' => 'EventController',
            'method' => 'desymbolize',
        ));
        Resource::create(array(
            'id' => 111,
            'controller' => 'EventController',
            'method' => 'setRepresenter',
        ));
        Resource::create(array(
            'id' => 112,
            'controller' => 'EventController',
            'method' => 'unsetRepresenter',
        ));
        Resource::create(array(
           'id' => 113,
            'controller' => 'FacebookController',
            'method' => 'redirectCatch',
        ));
    }
    
}
