<?php

use Rockit\Models\Representer;

class RepresentersTableSeeder extends Seeder {

    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('representers')->delete();
        
        Representer::create(array('id' => '1',
                                    'email' => 'kon.takt@bluewin.ch',
                                    'phone' => '078 222 44 66 88',
                                    'first_name'=>'Kon',
                                    'last_name'=> 'Takt',
                                    ));
        
        Representer::create(array('id'=> '2',
                                    'email' => 'ben@jamin.me',
                                    'first_name'=>'Ben',
                                    'last_name'=> 'Jamin',
                                    ));
        
        Representer::create(array('id'=> '3',
                                    'email' => 'manu.hart4@me.com',
                                    'first_name'=>'Manu',
                                    'last_name'=> 'Hartman',
                                    ));
        
        Representer::create(array('id'=> '4',
                                    'email' => 'hansjordi@topfirma.ch',
                                    'first_name'=>'Hansruedi',
                                    'last_name'=> 'Jordi',
                                    'phone' => '078 / 744 66 22',
                                    'street' => 'Gassestrasse 45',
                                    'npa' => '8742',
                                    'city' => 'Niederbipp',
                                    ));
        
        Representer::create(array('id'=> '5',
                                    'email' => 'fabloh@sbb.ch',
                                    'first_name'=>'Fabien',
                                    'last_name'=> 'Loh',
                                    'phone' => ' 0049 16 112 123 23 23',
                                    'street' => 'Superstrasse 2',
                                    'npa' => '7821-2130',
                                    'city' => 'Böblingen',
                                    'country'=> 'Deutschland',
                                    ));
        
        Representer::create(array('id'=> '6',
                                    'email' => 'hansjordi@topfirma.ch',
                                    'first_name'=>'Hansruedi',
                                    'last_name'=> 'Jordi',
                                    'phone' => '078 / 744 66 22',
                                    'street' => 'Gassestrasse 45',
                                    'npa' => '8742',
                                    'city' => 'Niederbipp',
                                    ));
        
         Representer::create(array('id'=> '7',
                                    'email' => 'sacha81@hotmail.com',
                                    'first_name'=>'Sarah',
                                    'last_name'=> 'Chacksad',
                                    'phone' => '078 / 7446622',
                                    ));
        
        

    }
}

