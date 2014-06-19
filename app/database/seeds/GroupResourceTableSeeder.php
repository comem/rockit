<?php

use Rockit\Group;

class GroupResourceTableSeeder extends Seeder {

    public function run() {
        DB::table('group_resource')->delete();
        // Staffs' specifics accesses
        Group::find(1)->resources()->sync(array(
            // index accesses
            32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45,
            // show accesses
            47, 48, 49, 50, 51, 52,
            // other accesses
            100, 101,
        ));
        // Managers' specifics accesses
        Group::find(2)->resources()->sync(array(
            // destroy accesses
            2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30,
            // store accesses
            54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82,
            // update accesses
            84, 85, 86, 87, 88, 89, 90, 91, 92, 93, 94, 95, 96, 97,
            // other accesses
            98, 99,
        ));
    }

}
