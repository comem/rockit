<?php

use Rockit\Gift;

//Gifts
class GiftsTableSeeder extends Seeder {

    public function run() {
        DB::table('gifts')->delete();

        Gift::create(array('id' => '1',
            'name_de' => 'Tickets (2 eintritts)'));

        Gift::create(array('id' => '2',
            'name_de' => 'Tickets (1 eintritt)'));

        Gift::create(array('name_de' => 'Cd'));

        Gift::create(array('name_de' => 'Fan Tasse'));

        Gift::create(array('name_de' => 'Fan shirt'));

        Gift::create(array('name_de' => 'Fan fan (lüfter)'));
    }

}
