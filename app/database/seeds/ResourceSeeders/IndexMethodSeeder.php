<?php

namespace ResourceSeeders;

use Rockit\Models\Resource;

class IndexMethodSeeder {

    public static function seed() {
        Resource::create(array(
            'id' => 32,
            'controller' => 'ArtistController',
            'method' => 'index',
        ));
        Resource::create(array(
            'id' => 33,
            'controller' => 'EquipmentController',
            'method' => 'index',
        ));
        Resource::create(array(
            'id' => 34,
            'controller' => 'EventController',
            'method' => 'index',
        ));
        Resource::create(array(
            'id' => 35,
            'controller' => 'EventTypeController',
            'method' => 'index',
        ));
        Resource::create(array(
            'id' => 36,
            'controller' => 'GenreController',
            'method' => 'index',
        ));
        Resource::create(array(
            'id' => 37,
            'controller' => 'GiftController',
            'method' => 'index',
        ));
        Resource::create(array(
            'id' => 38,
            'controller' => 'ImageController',
            'method' => 'index',
        ));
        Resource::create(array(
            'id' => 39,
            'controller' => 'InstrumentController',
            'method' => 'index',
        ));
        Resource::create(array(
            'id' => 40,
            'controller' => 'MemberController',
            'method' => 'index',
        ));
        Resource::create(array(
            'id' => 41,
            'controller' => 'MusicianController',
            'method' => 'index',
        ));
        Resource::create(array(
            'id' => 42,
            'controller' => 'PrintingTypeController',
            'method' => 'index',
        ));
        Resource::create(array(
            'id' => 43,
            'controller' => 'RepresenterController',
            'method' => 'index',
        ));
        Resource::create(array(
            'id' => 44,
            'controller' => 'SkillController',
            'method' => 'index',
        ));
        Resource::create(array(
            'id' => 45,
            'controller' => 'TicketCategoryController',
            'method' => 'index',
        ));
        Resource::create(array(
            'id' => 114,
            'controller' => 'SearchController',
            'method' => 'index',
        ));
    }

}
