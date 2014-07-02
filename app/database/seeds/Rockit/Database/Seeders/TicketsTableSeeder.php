<?php

namespace Rockit\Database\Seeders;

use \DB,
    Rockit\Models\Ticket,
    Rockit\Models\TicketCategory,
    Rockit\Models\Event;

//tickets
class TicketsTableSeeder extends \Seeder {

    public function run() {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('tickets')->delete();

        $ticketCategory = TicketCategory::all();
        $event = Event::all();

        Ticket::create(array('ticket_category_id' => $ticketCategory[0]->id,
            'event_id' => $event[0]->id,
            'amount' => 20));

        Ticket::create(array('ticket_category_id' => $ticketCategory[2]->id,
            'event_id' => $event[0]->id,
            'amount' => 0));

        Ticket::create(array('ticket_category_id' => '4',
            'event_id' => '4',
            'amount' => 10));

        Ticket::create(array('ticket_category_id' => '5',
            'event_id' => '4',
            'amount' => 19));

        Ticket::create(array('ticket_category_id' => $ticketCategory[3]->id,
            'event_id' => $event[1]->id,
            'amount' => 12));

        Ticket::create(array('ticket_category_id' => '2',
            'event_id' => '5',
            'amount' => 25));

        Ticket::create(array('ticket_category_id' => '1',
            'event_id' => '5',
            'amount' => 20));

        Ticket::create(array('ticket_category_id' => '2',
            'event_id' => '6',
            'amount' => 25));

        Ticket::create(array('ticket_category_id' => '1',
            'event_id' => '6',
            'amount' => 20));
    }

}
