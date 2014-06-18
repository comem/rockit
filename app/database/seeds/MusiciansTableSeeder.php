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
    }
}
