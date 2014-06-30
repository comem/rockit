<?php

use Rockit\Musician;

//Muscicians
class MusiciansTableSeeder extends Seeder {

    public function run() {
        DB::table('musicians')->delete();


        Musician::create(array('id' => '1',
            'first_name' => 'Paul',
            'last_name' => 'Einstein',
            'stagename' => 'Zweistein',
        ));

        Musician::create(array('id' => '2',
            'first_name' => 'Patrich',
            'last_name' => 'Frankenstein',
            'stagename' => 'Edelstein',
        ));

        Musician::create(array('id' => '3',
            'first_name' => 'Fabian',
            'last_name' => 'Hagelstein',
            'stagename' => 'Schneestein',
        ));

        Musician::create(array('id' => '4',
            'first_name' => 'Fritz',
            'last_name' => 'Hakerman',
            'stagename' => 'redbulp',
        ));
        Musician::create(array('id' => '5',
            'first_name' => 'Philipp',
            'last_name' => 'Gerber',
            'stagename' => 'Bluedög',
        ));
        Musician::create(array('id' => '6',
            'first_name' => 'J.C.',
            'stagename' => 'Wirth',
        ));

        Musician::create(array('id' => '7',
            'first_name' => 'Frederic',
            'stagename' => 'FreddySteady',
        ));
        Musician::create(array('id' => '8',
            'first_name' => 'Brigittte',
            'last_name' => 'Geiser',
            'stagename' => 'Brigitte Geiser',
        ));        
        Musician::create(array('id' => '9',
            'first_name' => 'Karl',
            'last_name' => 'Legerfeld',
            'stagename' => 'Bonzai',
        ));
        
        Musician::create(array('id' => '10',
            'first_name' => 'Joel',
            'last_name' => 'Affolter',
            'stagename' => 'Joel Affolter',
        ));
         
        Musician::create(array('id' => '11',
            'first_name' => 'Michel',
            'last_name' => 'Weber',
            'stagename' => 'Michel Weber',
        ));
        
        Musician::create(array('id' => '12',
            'first_name' => 'Francois',
            'last_name' => 'Hofer',
            'stagename' => 'Francois Hofer',
        ));
        
        Musician::create(array('id' => '13',
            'first_name' => 'Franz',
            'last_name' => 'Biffiger',
            'stagename' => 'Franz Biffiger',
        ));
        
        Musician::create(array('id' => '14',
            'first_name' => 'Hans',
            'last_name' => 'Steiner',
            'stagename' => 'Hans Steiner',
        ));
        
        Musician::create(array('id' => '15',
            'first_name' => 'Denise',
            'last_name' => 'Donatsch',
            'stagename' => 'Denise Donatsch',
        ));
         
        Musician::create(array('id' => '16',
            'first_name' => 'Cristoph',
            'last_name' => 'Thiel',
            'stagename' => 'Christop Thiel',
        ));
        
        Musician::create(array('id' => '17',
            'first_name' => 'Lucio',
            'last_name' => 'Crivellotto',
            'stagename' => 'Lucio Crivellotto',
        ));
        
        Musician::create(array('id' => '18',
            'first_name' => 'Jean-Luc',
            'last_name' => 'Gassman',
            'stagename' => 'Jean-Lus Gassman',
        ));
        
        Musician::create(array('id' => '19',
            'first_name' => 'Markus',
            'last_name' => 'Karl',
            'stagename' => 'Markus Karl',
        ));
         
        Musician::create(array('id' => '20',
            'first_name' => 'Thomas',
            'last_name' => 'Weibel',
            'stagename' => 'Thomas Weibel',
        ));
        
        Musician::create(array('id' => '21',
            'first_name' => 'Heinz',
            'last_name' => 'Richner',
            'stagename' => 'Heinz Richner',
        ));
        
        Musician::create(array('id' => '22',
            'first_name' => 'Andreas',
            'last_name' => 'Steiner',
            'stagename' => 'Special guest: Andreas Steiner',
        ));

        Musician::create(array('id' => '23',
            'first_name' => 'Roger',
            'last_name' => 'Dubler',
            'stagename' => 'Roger Dubler',
        ));
        
        Musician::create(array('id' => '24',
            'first_name' => 'Lajescha',
            'last_name' => 'Dubler',
            'stagename' => 'Lajescha Dubler',
        ));
        
        Musician::create(array('id' => '25',
            'first_name' => 'Isabelle',
            'last_name' => 'Rey',
            'stagename' => 'Isabelle Rey',
        ));
        
        Musician::create(array('id' => '26',
            'first_name' => 'Julian',
            'last_name' => 'Blech',
            'stagename' => 'Julian blech',
        ));
        
        Musician::create(array('id' => '27',
            'first_name' => 'Simon',
            'last_name' => 'Zwicky',
            'stagename' => 'Simon Zwicky',
        ));
        
        Musician::create(array('id' => '28',
            'first_name' => 'Hansruedi',
            'last_name' => 'Jordi',
            'stagename' => 'Hansruedi Jordi',
        ));
        
        Musician::create(array('id' => '29',
            'first_name' => 'Urs',
            'last_name' => 'Stephani',
            'stagename' => 'Urs Stephani',
        ));
        
        Musician::create(array('id' => '30',
            'first_name' => 'Roland Hirsiger',
            'last_name' => 'Roland',
            'stagename' => 'Hirsiger',
        ));
        
        Musician::create(array('id' => '31',
            'first_name' => 'Ernö',
            'last_name' => 'Mericske',
            'stagename' => 'Erno Mericske',
        ));
        
        Musician::create(array('id' => '32',
            'first_name' => 'Kurt',
            'last_name' => 'Von Allmen',
            'stagename' => 'Kort Von Allmen',
        ));
        
        Musician::create(array('id' => '33',
            'first_name' => 'Roland',
            'last_name' => 'Bürki',
            'stagename' => 'Roland Bürki',
        ));
        
        Musician::create(array('id' => '34',
            'first_name' => 'Manu',
            'last_name' => 'Hartman',
            'stagename' => 'Manu Hartman',
        ));
        
        Musician::create(array('id' => '35',
            'first_name' => 'Stephan',
            'last_name' => 'Schätti',
            'stagename' => 'Stephan Schätti',
        ));
        
        Musician::create(array('id' => '36',
            'first_name' => 'Emanuel',
            'last_name' => 'Teschke',
            'stagename' => 'Emanuel Teschke',
        ));
        
        Musician::create(array('id' => '37',
            'first_name' => 'Yiannis',
            'last_name' => 'Pappay',
            'stagename' => 'Yiannis Pappay',
        ));
        
        Musician::create(array('id' => '38',
            'first_name' => 'cedric',
            'last_name' => 'Vogel',
            'stagename' => 'Cedric Vogel',
        ));
        
        
    }

}
