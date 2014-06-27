<?php

use Rockit\Musician;

//Muscicians
class MusiciansTableSeeder extends Seeder {

    public function run() {
        DB::table('musicians')->delete();

        Musician::create(array('id' => '0',
            'first_name' => 'Karl',
            'last_name' => 'Legerfeld',
            'stagename' => 'Bonzai',
        ));

        Musician::create(array('id' => '1',
            'first_name' => 'Paul',
            'last_name' => 'Einstein',
            'stagename' => 'Zweistein',
        ));

        Musician::create(array('id' => '2',
            'first_name' => 'Patrich',
            'last_name' => 'Frankenstein',
            'stagename' => 'Edelstein',
        ));

        Musician::create(array('id' => '3',
            'first_name' => 'Fabian',
            'last_name' => 'Hagelstein',
            'stagename' => 'Schneestein',
        ));

        Musician::create(array('id' => '4',
            'first_name' => 'Fritz',
            'last_name' => 'Hakerman',
            'stagename' => 'redbulp',
        ));
        Musician::create(array('id' => '5',
            'first_name' => 'Philipp',
            'last_name' => 'Gerber',
            'stagename' => 'Bluedög',
        ));
        Musician::create(array('id' => '6',
            'stagename' => 'J.C. Wirth',
        ));

        Musician::create(array('id' => '7',
            'first_name' => 'Frederic',
            'stagename' => 'FreddySteady',
        ));
        Musician::create(array('id' => '8',
            'first_name' => 'Brigittte',
            'last_name' => 'Geiser',
            'stagename' => 'Brigitte Geiser',
        ));
    }

}
