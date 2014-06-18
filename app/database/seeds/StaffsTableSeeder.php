<?php

use Rockit\Staff;
use Rockit\Event;
use Rockit\Member;
use Rockit\Skill;

//staffs
class StaffsTableSeeder extends Seeder {

    public function run()
    {
        $event = Event::all();
        $member = Member::all();
        $skill = Skill::all();

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('staffs')->delete();

        Staff::create(array('member_id' => $member[0]->id,
                            'event_id'=> $event[0]->id,
                            'skill_id'=> $skill[0]->id));
    }
}

