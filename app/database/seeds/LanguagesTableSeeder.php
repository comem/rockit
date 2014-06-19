<?php

use Rockit\Language;

//languages
class LanguagesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('languages')->delete();

        Language::create(array('locale' => 'ch-de',
                                'name'=> 'Deutsch'));
    }
}

