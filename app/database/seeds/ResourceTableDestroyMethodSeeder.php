<?php

use Rockit\Resource;

class ResourceTableDestroyMethodSeeder {

    public static function seed() {
        DB::table('resources')->delete();
        Resource::create(array(
            'id' => 1,
            'controller' => 'AddressController',
            'method' => 'destroy',
        ));
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
            'controller' => 'IllustrationController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 12,
            'controller' => 'ImageController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 13,
            'controller' => 'InstrumentController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 14,
            'controller' => 'LineupController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 15,
            'controller' => 'LinkController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 16,
            'controller' => 'MemberController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 17,
            'controller' => 'MusicianController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 18,
            'controller' => 'NeedController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 19,
            'controller' => 'OfferController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 20,
            'controller' => 'PerformerController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 21,
            'controller' => 'PrintingController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 22,
            'controller' => 'PrintingTypeController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 23,
            'controller' => 'SharingController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 24,
            'controller' => 'SkillController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 25,
            'controller' => 'StaffController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 26,
            'controller' => 'SymbolizationController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 27,
            'controller' => 'TicketController',
            'method' => 'destroy',
        ));
        Resource::create(array(
            'id' => 28,
            'controller' => 'TicketCategoryController',
            'method' => 'destroy',
        ));
    }

}
