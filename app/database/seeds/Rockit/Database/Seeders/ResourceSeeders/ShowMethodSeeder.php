<?php

namespace Rockit\Database\Seeders\ResourceSeeders;

use Rockit\Models\Resource;

class ShowMethodSeeder {
    
    public static function seed(){
        Resource::create(array(
            'id' => 47,
            'controller' => 'ArtistController',
            'method' => 'show',
        ));
        Resource::create(array(
            'id' => 48,
            'controller' => 'EventController',
            'method' => 'show',
        ));
        Resource::create(array(
            'id' => 49,
            'controller' => 'ImageController',
            'method' => 'show',
        ));
        Resource::create(array(
            'id' => 50,
            'controller' => 'MemberController',
            'method' => 'show',
        ));
        Resource::create(array(
            'id' => 51,
            'controller' => 'MusicianController',
            'method' => 'show',
        ));
        Resource::create(array(
            'id' => 52,
            'controller' => 'RepresenterController',
            'method' => 'show',
        ));
    }
}
