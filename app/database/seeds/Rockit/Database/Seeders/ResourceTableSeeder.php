<?php

namespace Rockit\Database\Seeders;

use \DB,
    Rockit\Database\Seeders\ResourceSeeders\DestroyMethodSeeder,
    Rockit\Database\Seeders\ResourceSeeders\IndexMethodSeeder,
    Rockit\Database\Seeders\ResourceSeeders\ShowMethodSeeder,
    Rockit\Database\Seeders\ResourceSeeders\StoreMethodSeeder,
    Rockit\Database\Seeders\ResourceSeeders\UpdateMethodSeeder,
    Rockit\Database\Seeders\ResourceSeeders\OtherMethodSeeder;

class ResourceTableSeeder extends \Seeder {

    public function run() {
        DB::table('resources')->delete();
        DestroyMethodSeeder::seed();
        IndexMethodSeeder::seed();
        ShowMethodSeeder::seed();
        StoreMethodSeeder::seed();
        UpdateMethodSeeder::seed();
        OtherMethodSeeder::seed();
    }

}
