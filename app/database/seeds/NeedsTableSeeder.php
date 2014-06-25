<?php

use Rockit\Need;
use Rockit\Event;
use Rockit\Skill;

//events_needs
class NeedsTableSeeder extends Seeder {

    public function run()
    {
        $event = Event::all();
        $skill = Skill::all();

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('needs')->delete();

        Need::create(array('skill_id' => $skill[0]->id,
                                'event_id' => $event[0]->id,
                                'nb_people' => '2'));
        
        Need::create(array('skill_id' => $skill[1]->id,
                                'event_id' => $event[0]->id,
                                'nb_people' => '1'));
        
        Need::create(array('skill_id' => $skill[2]->id,
                                'event_id' => $event[0]->id,
                                'nb_people' => '1'));
        
        Need::create(array('skill_id' => $skill[0]->id,
                                'event_id' => $event[1]->id,
                                'nb_people' => '1'));
        
        Need::create(array('skill_id' => $skill[2]->id,
                                'event_id' => $event[1]->id,
                                'nb_people' => '1'));
        
        Need::create(array('skill_id' => $skill[1]->id,
                                'event_id' => $event[2]->id,
                                'nb_people' => '1'));
        
        Need::create(array('skill_id' => $skill[0]->id,
                                'event_id' => $event[2]->id,
                                'nb_people' => '1'));
        }
}

