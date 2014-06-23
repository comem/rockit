<?php

use Rockit\Offer;
use Rockit\Gift;
use Rockit\Event;

//offers
class OffersTableSeeder extends Seeder {

    public function run()
    {
        $gift = Gift::all();
        $event = Event::all();

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('offers')->delete();

        Offer::create(array('gift_id' => $gift[0]->id,
                            'event_id' => $event[0]->id,
                            'quantity' => 4,
                            'cost' => 0,
                            'comment_de' => 'Frei :-)' ));
        
        Offer::create(array('gift_id' => $gift[3]->id,
                            'event_id' => $event[1]->id,
                            'quantity' => 4,
                            'cost' => 0,
                            'comment_de' => 'Bitte nicht überall kleeeeeeeeben !' ));
        
        Offer::create(array('gift_id' => $gift[2]->id,
                            'event_id' => $event[0]->id,
                            'quantity' => 4,
                            'cost' => 0,
                            'comment_de' => 'Bitte nicht überall kleeeeeeeeben !' ));
    }
}

