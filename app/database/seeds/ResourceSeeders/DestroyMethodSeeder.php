<?php

namespace ResourceSeeders;

use Rockit\Resource;

class DestroyMethodSeeder {

    public static function seed() {
        Resource::create(array(
            'id' => 2,
            'controller' => 'ArtistController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 3,
            'controller' => 'AttributionController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 4,
            'controller' => 'DescriptionController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 5,
            'controller' => 'EquipmentController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 6,
            'controller' => 'EventController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 7,
            'controller' => 'EventTypeController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 8,
            'controller' => 'FulfillmentController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 9,
            'controller' => 'GenreController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 10,
            'controller' => 'GiftController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 11,
            'controller' => 'GuaranteeController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 12,
            'controller' => 'IllustrationController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 13,
            'controller' => 'ImageController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 14,
            'controller' => 'InstrumentController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 15,
            'controller' => 'LineupController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 16,
            'controller' => 'LinkController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 17,
            'controller' => 'MemberController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 18,
            'controller' => 'MusicianController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 19,
            'controller' => 'NeedController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 20,
            'controller' => 'OfferController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 21,
            'controller' => 'PerformerController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 22,
            'controller' => 'PrintingController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 23,
            'controller' => 'PrintingTypeController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 24,
            'controller' => 'RepresenterController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 25,
            'controller' => 'SharingController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 26,
            'controller' => 'SkillController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 27,
            'controller' => 'StaffController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 28,
            'controller' => 'SymbolizationController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 29,
            'controller' => 'TicketController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 30,
            'controller' => 'TicketCategoryController',
            'method' => 'destroy',
        ));
    }

}
