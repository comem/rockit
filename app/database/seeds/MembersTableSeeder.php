<?php

use Rockit\Member;

//members
class MembersTableSeeder extends Seeder {

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('members')->delete();

        Member::create(array('first_name'=>'Steeve',
                                'last_name'=>'Kocher',
                                'email' => 'foo@bar.com'));
    }
}

