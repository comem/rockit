<?php

use Rockit\Models\TicketCategory;

//ticket_categories
class TicketCategoriesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('ticket_categories')->delete();

        TicketCategory::create(array('id'=>'1',
            'name_de' => 'redurziert'));
        
        TicketCategory::create(array('id'=>'2',
            'name_de' => 'normal'));
        
        TicketCategory::create(array('id'=>'3',
            'name_de' => 'Kind'));
        
        TicketCategory::create(array('id'=>'4',
            'name_de' => 'Tanz & Party ab 18.30 Uhr'));
        
        TicketCategory::create(array('id'=>'5',
            'name_de' => 'Inkl pre-Party Workshop'));
        
        TicketCategory::create(array('id'=>'6',
            'name_de' => 'frei'));
    }
}

