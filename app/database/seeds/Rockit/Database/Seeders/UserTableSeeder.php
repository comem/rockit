<?php

namespace Rockit\Database\Seeders;

use \DB,
    \User,
    \Hash;

class UserTableSeeder extends \Seeder {

    public function run() {
        DB::table('users')->delete();

        // Users belonging to 'Managers'
        User::create(array(
            'email' => 'chris@chris.ch',
            'first_name' => 'Christian',
            'last_name' => 'Heimann',
            'password' => Hash::make('chris'),
            'language_id' => 1,
            'group_id' => 2,
        ));
        User::create(array(
            'email' => 'guzi@guzi.ch',
            'first_name' => 'Christopher',
            'last_name' => 'De Guzman',
            'password' => Hash::make('guzi'),
            'language_id' => 3,
            'group_id' => 2,
        ));
        User::create(array(
            'email' => 'matou@matou.ch',
            'first_name' => 'Mathias',
            'last_name' => 'Oberson',
            'password' => Hash::make('matou'),
            'language_id' => 2,
            'group_id' => 2,
        ));
        User::create(array(
            'email' => 'joel@joel.ch',
            'first_name' => 'Joël',
            'last_name' => 'Gugger',
            'password' => Hash::make('joel'),
            'language_id' => 2,
            'group_id' => 2,
        ));
        User::create(array(
            'email' => 'bob@bob.ch',
            'first_name' => 'Robert',
            'last_name' => 'di Rosa',
            'password' => Hash::make('bob'),
            'language_id' => 1,
            'group_id' => 2,
        ));

        // Users belonging to 'Staffs'
        User::create(array(
            'email' => 'de@staff.ch',
            'first_name' => 'Deutsch',
            'last_name' => 'Staff',
            'password' => Hash::make('staff'),
            'language_id' => 1,
            'group_id' => 1,
        ));
        User::create(array(
            'email' => 'fr@staff.ch',
            'first_name' => 'Français',
            'last_name' => 'Staff',
            'password' => Hash::make('staff'),
            'language_id' => 2,
            'group_id' => 1,
        ));
    }

}
