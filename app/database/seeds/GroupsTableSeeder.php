<?php

use Rockit\Group;

//groups
class GroupsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('groups')->delete();

        Group::create(array('name_de' => 'Staff'));

        Group::create(array('name_de' => 'Administration'));
    }
}

