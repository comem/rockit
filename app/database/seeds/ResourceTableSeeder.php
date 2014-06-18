<?php

class ResourceTableSeeder extends Seeder {

    public function run() {
        DB::table('resources')->delete();
        ResourceTableDestroyMethodSeeder::seed();
    }

}
