<?php

use Rockit\TicketCategory;

//ticket_categories
class TicketCategoriesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('ticket_categories')->delete();

        TicketCategory::create(array('name_de' => 'freier eintritt'));
    }
}

