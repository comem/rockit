<?php

use Rockit\Fulfillment;
use Rockit\Member;
use Rockit\Skill;

//member_skills
class FulfillmentsTableSeeder extends Seeder {

    public function run()
    {

        $member = Member::all();
        $skill = Skill::all();

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('fulfillments')->delete();

        Fulfillment::create(array('skill_id' => $skill[0]->id,
                                    'member_id'=> $member[0]->id));

    }
}
