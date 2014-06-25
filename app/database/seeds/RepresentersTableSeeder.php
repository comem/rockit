<?php

use Rockit\Representer;

class RepresentersTableSeeder extends Seeder {

    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('representers')->delete();

        Representer::create(array('email' => 'Bucher@gmx.ch',
                                    'first_name'=>'Hans',
                                    'last_name'=> 'Kochman',
                                    ));
        
        Representer::create(array('email' => 'kon.takt@bluewin.ch',
                                    'phone' => '078 222 44 66 88',
                                    'first_name'=>'Kon',
                                    'last_name'=> 'Takt',
                                    ));
        
        Representer::create(array('email' => 'ben@jamin.me',
                                    'first_name'=>'Ben',
                                    'last_name'=> 'Jamin',
                                    ));

    }
}

