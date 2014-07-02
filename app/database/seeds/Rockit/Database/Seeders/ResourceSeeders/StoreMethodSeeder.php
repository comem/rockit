<?php

namespace Rockit\Database\Seeders\ResourceSeeders;

use Rockit\Models\Resource;

class StoreMethodSeeder {

    public static function seed() {
        Resource::create(array(
            'id' => 54,
            'controller' => 'ArtistController',
            'method' => 'store',
        ));
        Resource::create(array(
            'id' => 55,
            'controller' => 'AttributionController',
            'method' => 'store',
        ));
        Resource::create(array(
            'id' => 56,
            'controller' => 'DescriptionController',
            'method' => 'store',
        ));
        Resource::create(array(
            'id' => 57,
            'controller' => 'EquipmentController',
            'method' => 'store',
        ));
        Resource::create(array(
            'id' => 58,
            'controller' => 'EventController',
            'method' => 'store',
        ));
        Resource::create(array(
            'id' => 59,
            'controller' => 'EventTypeController',
            'method' => 'store',
        ));
        Resource::create(array(
            'id' => 60,
            'controller' => 'FulfillmentController',
            'method' => 'store',
        ));
        Resource::create(array(
            'id' => 61,
            'controller' => 'GenreController',
            'method' => 'store',
        ));
        Resource::create(array(
            'id' => 62,
            'controller' => 'GiftController',
            'method' => 'store',
        ));
        Resource::create(array(
            'id' => 63,
            'controller' => 'GuaranteeController',
            'method' => 'store',
        ));
        Resource::create(array(
            'id' => 64,
            'controller' => 'IllustrationController',
            'method' => 'store',
        ));
        Resource::create(array(
            'id' => 65,
            'controller' => 'ImageController',
            'method' => 'store',
        ));
        Resource::create(array(
            'id' => 66,
            'controller' => 'InstrumentController',
            'method' => 'store',
        ));
        Resource::create(array(
            'id' => 67,
            'controller' => 'LineupController',
            'method' => 'store',
        ));
        Resource::create(array(
            'id' => 68,
            'controller' => 'LinkController',
            'method' => 'store',
        ));
        Resource::create(array(
            'id' => 69,
            'controller' => 'MemberController',
            'method' => 'store',
        ));
        Resource::create(array(
            'id' => 70,
            'controller' => 'MusicianController',
            'method' => 'store',
        ));
        Resource::create(array(
            'id' => 71,
            'controller' => 'NeedController',
            'method' => 'store',
        ));
        Resource::create(array(
            'id' => 72,
            'controller' => 'OfferController',
            'method' => 'store',
        ));
        Resource::create(array(
            'id' => 73,
            'controller' => 'PerformerController',
            'method' => 'store',
        ));
        Resource::create(array(
            'id' => 74,
            'controller' => 'PrintingController',
            'method' => 'store',
        ));
        Resource::create(array(
            'id' => 75,
            'controller' => 'PrintingTypeController',
            'method' => 'store',
        ));
        Resource::create(array(
            'id' => 76,
            'controller' => 'RepresenterController',
            'method' => 'store',
        ));
        Resource::create(array(
            'id' => 77,
            'controller' => 'SharingController',
            'method' => 'store',
        ));
        Resource::create(array(
            'id' => 78,
            'controller' => 'SkillController',
            'method' => 'store',
        ));
        Resource::create(array(
            'id' => 79,
            'controller' => 'StaffController',
            'method' => 'store',
        ));
        Resource::create(array(
            'id' => 80,
            'controller' => 'SymbolizationController',
            'method' => 'store',
        ));
        Resource::create(array(
            'id' => 81,
            'controller' => 'TicketController',
            'method' => 'store',
        ));
        Resource::create(array(
            'id' => 82,
            'controller' => 'TicketCategoryController',
            'method' => 'store',
        ));
    }

}
