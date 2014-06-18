<?php

use Rockit\Group;

class GroupTableSeeder extends Seeder {
    
    public function run() {
        DB::table('groups')->delete();
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
