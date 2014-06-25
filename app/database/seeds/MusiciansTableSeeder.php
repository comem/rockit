<?php

use Rockit\Musician;

//Muscicians
class MusiciansTableSeeder extends Seeder {

    public function run()
    {
        DB::table('musicians')->delete();

        Musician::create(array('first_name' => 'Karl',
        					'last_name'=> 'Legerfeld',
        					'stagename'=>'Bonzai',
        					));
        
         Musician::create(array('first_name' => 'Paul',
        					'last_name'=> 'Einstein',
        					'stagename'=>'Zweistein',
        					));
        
          Musician::create(array('first_name' => 'Patrich',
        					'last_name'=> 'Frankenstein',
        					'stagename'=>'Edelstein',
        					));
           
          Musician::create(array('first_name' => 'Fabian',
        					'last_name'=> 'Hagelstein',
        					'stagename'=>'Schneestein',
        					));
        
          Musician::create(array('first_name' => 'Fritz',
        					'last_name'=> 'Hakerman',
        					'stagename'=>'redbulp',
        					));
          
          
          
          
        
        
        
    }
}
