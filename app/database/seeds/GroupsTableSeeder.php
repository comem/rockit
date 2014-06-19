<?php

use Rockit\Group;

//groups
class GroupsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('groups')->delete();

        Group::create(array('name' => 'Staff'));

        Group::create(array('name' => 'Administration'));
    }
}

