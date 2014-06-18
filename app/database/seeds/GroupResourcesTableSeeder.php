<?php

use Rockit\GroupResource;
use Rockit\Group;
use Rockit\Resource;

//group_ressources
class GroupResourcesTableSeeder extends Seeder {

    public function run()
    {   
        $group = Group::all();
        $resource = Resource::all();

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('group_resource')->delete();

        GroupResource::create(array('group_id' => $group[0]->id,
                                    'resource_id'=>$resource[0]->id));
    }
}

