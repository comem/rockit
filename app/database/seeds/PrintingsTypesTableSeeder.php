<?php

use Rockit\Models\PrintingType;

//printings_types
class PrintingsTypesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('printing_types')->delete();

        PrintingType::create(array('id'=>'1',
            'name_de' => 'flyer'));
        
        PrintingType::create(array('id'=>'2',
            'name_de' => 'Plakart'));
        
        PrintingType::create(array('id'=>'3',
            'name_de' => 'Postkarte'));
        
        PrintingType::create(array('id'=>'4',
            'name_de' => 'Plakart gross'));
    }
}

