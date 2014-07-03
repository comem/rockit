<?php

namespace Rockit\Database\Seeders;

use \DB,
    Rockit\Models\Group;

class GroupTableSeeder extends \Seeder {

    public function run() {
        DB::table('groups')->delete(2);
        DB::table('groups')->delete(1);
        Group::create(array(
            'id' => 1,
            'name' => 'Staffs',
        ));
        Group::create(array(
            'id' => 2,
            'name' => 'Managers',
            'group_id' => 1,
        ));
    }

}
