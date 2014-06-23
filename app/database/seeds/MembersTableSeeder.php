<?php

use Rockit\Member;

//members
class MembersTableSeeder extends Seeder {

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('members')->delete();

        Member::create(array(
            'first_name'=>'Steeve',
            'last_name'=>'Kocher',
            'email' => 'foo@bar.com',
            'is_active' => true,
            'street' => 'Gasser halle 3',
            'npa' => '1345',
            'city' => 'Zufingen',         
        ));
        
        Member::create(array(
            'first_name'=>'Maia',
            'last_name'=>'Bine',
            'email' => 'blumenliebeich@hotmail.com',
            'is_active' => true,
            'street' => 'Auf dem Hof 78',
            'npa' => '8567',
            'city' => 'Pfäffikon',         
        ));
        
        Member::create(array(
            'first_name'=>'Garfield',
            'last_name'=>'Schlafmütze',
            'email' => 'mico@betttester.ch',
            'is_active' => true,
            'street' => 'Ikea, Bett department',
            'npa' => '3002',
            'city' => '',         
        )); 
        
        Member::create(array(
            'first_name'=>'Tim',
            'last_name'=>'Lachen',
            'email' => 'Happy@teamplayer.ch',
            'is_active' => true,
            'street' => 'Guter Laune Strasse 2',
            'npa' => '3672',
            'city' => 'Lachen',         
        ));  
    }
}

