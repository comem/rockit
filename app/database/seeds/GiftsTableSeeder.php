<?php

use Rockit\Gift;

//Gifts
class GiftsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('gifts')->delete();

        Gift::create(array('name_de' => 'Tickets (eintritts'));
        
        Gift::create(array('name_de' => 'Cd'));
        
        Gift::create(array('name_de' => 'Fan mug'));
        
        Gift::create(array('name_de' => 'Fan shirt'));
        
        Gift::create(array('name_de' => 'Fan fan (lüfter)'));
    }
}

