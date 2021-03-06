<?php

namespace Rockit\Database\Seeders;

use \DB,
    Rockit\Models\Fulfillment,
    Rockit\Models\Member,
    Rockit\Models\Skill;

//member_skills
class FulfillmentsTableSeeder extends \Seeder {

    public function run() {

        $member = Member::all();
        $skill = Skill::all();

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('fulfillments')->delete();

        Fulfillment::create(array('skill_id' => $skill[0]->id,
            'member_id' => $member[0]->id));

        Fulfillment::create(array('skill_id' => $skill[0]->id,
            'member_id' => $member[2]->id));

        Fulfillment::create(array('skill_id' => $skill[0]->id,
            'member_id' => $member[3]->id));

        Fulfillment::create(array('skill_id' => $skill[1]->id,
            'member_id' => $member[0]->id));

        Fulfillment::create(array('skill_id' => $skill[1]->id,
            'member_id' => $member[3]->id));

        Fulfillment::create(array('skill_id' => $skill[2]->id,
            'member_id' => $member[1]->id));

        //Member::find(5)->skills->attach(5);
    }

}
