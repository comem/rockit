<?php

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Eloquent::unguard();
        $this->call('ResourceTableSeeder');
        $this->call('GroupTableSeeder');
        $this->call('LanguageTableSeeder');
        $this->call('UserTableSeeder');
        $this->call('GroupResourceTableSeeder');
    }

}
