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
        
        Staff::create(array('member_id' => $member[1]->id,
                            'event_id'=> $event[0]->id,
                            'skill_id'=> $skill[2]->id));
        
        Staff::create(array('member_id' => $member[2]->id,
                            'event_id'=> $event[0]->id,
                            'skill_id'=> $skill[3]->id));
        
        Staff::create(array('member_id' => $member[1]->id,
                            'event_id'=> $event[1]->id,
                            'skill_id'=> $skill[3]->id));
        
        Staff::create(array('member_id' => $member[1]->id,
                            'event_id'=> $event[2]->id,
                            'skill_id'=> $skill[0]->id));
        
        Staff::create(array('member_id' => $member[3]->id,
                            'event_id'=> $event[2]->id,
                            'skill_id'=> $skill[1]->id));
        
        Staff::create(array('member_id' => $member[3]->id,
                            'event_id'=> $event[1]->id,
                            'skill_id'=> $skill[3]->id));
        
    }
}

