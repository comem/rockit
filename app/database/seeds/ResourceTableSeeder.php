<?php

use ResourceSeeders\DestroyMethodSeeder;
use ResourceSeeders\IndexMethodSeeder;
use ResourceSeeders\ShowMethodSeeder;
use ResourceSeeders\StoreMethodSeeder;
use ResourceSeeders\UpdateMethodSeeder;
use ResourceSeeders\OtherMethodSeeder;

class ResourceTableSeeder extends Seeder {

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
