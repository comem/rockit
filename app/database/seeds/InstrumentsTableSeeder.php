<?php

use Rockit\Instrument;

//instruments
class InstrumentsTableSeeder extends Seeder {

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('instruments')->delete();
        
        Instrument::create(array('id'=>'1','name_de' => 'Vocals'));
        
        Instrument::create(array('id'=>'2','name_de' => 'Bass'));
        
        Instrument::create(array('id'=>'3','name_de' => 'Backvocals'));
        
        Instrument::create(array('id'=>'4','name_de' => 'Drum'));
        
        Instrument::create(array('id'=>'5','name_de' => 'Organ'));
        
        Instrument::create(array('id'=>'6','name_de' => 'Dj'));
        
        Instrument::create(array('id'=>'7','name_de' => 'Acoustic guitar'));
        
        Instrument::create(array('id'=>'8','name_de' => 'Electric guitar'));
        
        Instrument::create(array('id'=>'9','name_de' => 'Lead-Vocals'));
        
        Instrument::create(array('id'=>'10','name_de' => 'Electric Pianoo'));
        
        Instrument::create(array('id'=>'11','name_de' => 'Whistle'));
        
        Instrument::create(array('id'=>'12','name_de' => 'Fiddle'));
        
        Instrument::create(array('id'=>'13','name_de' => 'Backings'));
        
        Instrument::create(array('id'=>'14','name_de' => 'Percussion'));
        
        Instrument::create(array('id'=>'15','name_de' => 'trumpet'));
        
        Instrument::create(array('id'=>'16','name_de' => 'flugelhorn'));
        
        Instrument::create(array('id'=>'17','name_de' => 'Saxes'));
        
        Instrument::create(array('id'=>'18','name_de' => 'Clarinet'));
        
        Instrument::create(array('id'=>'19','name_de' => 'Trombon'));
        
        Instrument::create(array('id'=>'20','name_de' => 'Pianoo'));
        
        Instrument::create(array('id'=>'21','name_de' => 'Contrebass'));
        
        Instrument::create(array('id'=>'22','name_de' => 'Rhodes'));




    }
}
