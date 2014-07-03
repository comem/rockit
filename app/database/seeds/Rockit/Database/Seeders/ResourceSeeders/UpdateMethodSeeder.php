<?php

namespace Rockit\Database\Seeders\ResourceSeeders;

use Rockit\Models\Resource;

class UpdateMethodSeeder {

    public static function seed() {
        Resource::create(array(
            'id' => 84,
            'controller' => 'ArtistController',
            'method' => 'update',
        ));
        Resource::create(array(
            'id' => 85,
            'controller' => 'AttributionController',
            'method' => 'update',
        ));
        Resource::create(array(
            'id' => 86,
            'controller' => 'EventController',
            'method' => 'update',
        ));
        Resource::create(array(
            'id' => 87,
            'controller' => 'ImageController',
            'method' => 'update',
        ));
        Resource::create(array(
            'id' => 88,
            'controller' => 'LinkController',
            'method' => 'update',
        ));
        Resource::create(array(
            'id' => 89,
            'controller' => 'MemberController',
            'method' => 'update',
        ));
        Resource::create(array(
            'id' => 90,
            'controller' => 'MusicianController',
            'method' => 'update',
        ));
        Resource::create(array(
            'id' => 91,
            'controller' => 'NeedController',
            'method' => 'update',
        ));
        Resource::create(array(
            'id' => 92,
            'controller' => 'OfferController',
            'method' => 'update',
        ));
        Resource::create(array(
            'id' => 93,
            'controller' => 'PerformerController',
            'method' => 'update',
        ));
        Resource::create(array(
            'id' => 94,
            'controller' => 'PrintingController',
            'method' => 'update',
        ));
        Resource::create(array(
            'id' => 95,
            'controller' => 'RepresenterController',
            'method' => 'update',
        ));
        Resource::create(array(
            'id' => 96,
            'controller' => 'StaffController',
            'method' => 'update',
        ));
        Resource::create(array(
            'id' => 97,
            'controller' => 'TicketController',
            'method' => 'update',
        ));
    }

}
