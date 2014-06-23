<?php

use Rockit\Instrument;

//instruments
class InstrumentsTableSeeder extends Seeder {

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('instruments')->delete();

        Instrument::create(array('name_de' => 'Flöte'));
        
        Instrument::create(array('name_de' => 'Gitarre'));
        
        Instrument::create(array('name_de' => 'Batterie'));
        
        Instrument::create(array('name_de' => 'Singer'));
        
        Instrument::create(array('name_de' => 'Dreieckspieler'));
        
    }
}