<?php

use Rockit\Gift;

//Gifts
class GiftsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('gifts')->delete();

        Gift::create(array('name_de' => 'Tickets (eintritts'));
    }
}

