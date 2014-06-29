<?php

use Rockit\Skill;

//skills
class SkillsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('skills')->delete();

        Skill::create(array('name_de' => 'Bar'));
        
        Skill::create(array('name_de' => 'Kasse'));
        
        Skill::create(array('name_de' => 'Abendchef'));
        
        Skill::create(array('name_de' => 'Technik'));
        
   }
}

