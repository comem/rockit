<?php

use Rockit\TicketCategory;

//ticket_categories
class TicketCategoriesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('ticket_categories')->delete();

        TicketCategory::create(array('name_de' => 'freier eintritt'));
        
        TicketCategory::create(array('name_de' => 'Student eintritt'));
        
        TicketCategory::create(array('name_de' => 'Normales eintritt'));
        
        TicketCategory::create(array('name_de' => 'Kind eintritt'));
        
        TicketCategory::create(array('name_de' => 'AVS eintritt'));
        
        TicketCategory::create(array('name_de' => 'Totales hapenning eintritt'));
        
        TicketCategory::create(array('name_de' => 'Ohne hapenning eintritt'));
    }
}

