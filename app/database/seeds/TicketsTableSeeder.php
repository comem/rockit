<?php

use Rockit\Ticket;
use Rockit\TicketCategory;
use Rockit\Event;

//tickets
class TicketsTableSeeder extends Seeder {

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('tickets')->delete();

        $ticketCategory = TicketCategory::all();
        $event = Event::all();

        Ticket::create(array('ticket_category_id' => $ticketCategory[0]->id,
                                'event_id'=>$event[0]->id,
                                'amount' => 20));
        
        Ticket::create(array('ticket_category_id' => $ticketCategory[2]->id,
                                'event_id'=>$event[0]->id,
                                'amount' => 0));
        
        Ticket::create(array('ticket_category_id' => $ticketCategory[4]->id,
                                'event_id'=>$event[0]->id,
                                'amount' => 10));
        
        Ticket::create(array('ticket_category_id' => $ticketCategory[0]->id,
                                'event_id'=>$event[1]->id,
                                'amount' => 20));
        
        Ticket::create(array('ticket_category_id' => $ticketCategory[3]->id,
                                'event_id'=>$event[1]->id,
                                'amount' => 12));
        
    }
}

