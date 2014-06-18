<?php

use rockit\User;
use rockit\Language;

//staffs
class UsersTableSeeder extends Seeder {

    public function run()
    {
        $language = Language::all();
        
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('users')->delete();

        User::create(array( 'language_id'=> $language[0]->id,
                            'email'=> '',
                            'first_name'=>'',
                            'last_name'=>'',
                            'password'=>Hash::make('1234'),
            ));
    }
}
