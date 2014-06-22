<?php

use Rockit\Skill;

//skills
class SkillsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('skills')->delete();

        Skill::create(array('name_de' => 'Barman / Barmaid'));
        
        Skill::create(array('name_de' => 'Ticketverkäufer'));
        
        Skill::create(array('name_de' => 'Auffräumen'));
        
        Skill::create(array('name_de' => 'Empfangsdame'));
        
        Skill::create(array('name_de' => 'Eventorganiser'));
   }
}

