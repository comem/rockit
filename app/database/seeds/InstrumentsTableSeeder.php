<?php

use Rockit\Instrument;

//instruments
class InstrumentsTableSeeder extends Seeder {

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('instruments')->delete();

        Instrument::create(array('id'=>'7','name_de' => 'Guitar'));
        
        Instrument::create(array('id'=>'1','name_de' => 'Vocals'));
        
        Instrument::create(array('id'=>'2','name_de' => 'Bass'));
        
        Instrument::create(array('id'=>'3','name_de' => 'Backvocals'));
        
        Instrument::create(array('id'=>'4','name_de' => 'Drum'));
        
        Instrument::create(array('id'=>'5','name_de' => 'Organ'));
        
        Instrument::create(array('id'=>'6','name_de' => 'Dj'));
        
    }
}