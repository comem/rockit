<?php

use Rockit\Models\Language;

class LanguageTableSeeder extends Seeder {
    
    public function run() {
        DB::table('languages')->delete();
        Language::create(array(
            'id' => 1,
            'locale' => 'de',
            'name' => 'Deutsch',
        ));
        Language::create(array(
            'id' => 2,
            'locale' => 'fr',
            'name' => 'Français',
        ));
        Language::create(array(
            'id' => 3,
            'locale' => 'en',
            'name' => 'English',
        ));
    }
}
