<?php

use Rockit\PrintingType;

//printings_types
class PrintingsTypesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('printing_types')->delete();

        PrintingType::create(array('name_de' => 'flyer'));
        
        PrintingType::create(array('name_de' => 'A4 Blatt'));
        
        PrintingType::create(array('name_de' => 'Sticker'));
    }
}

