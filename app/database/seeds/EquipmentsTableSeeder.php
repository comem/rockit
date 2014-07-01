<?php

use Rockit\Models\Equipment;

//Equipments	
class EquipmentsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('equipments')->delete();

        Equipment::create(array('id'=>'1',
                                'name_de' => 'Piano'));
    }
}
