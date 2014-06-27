<?php

use Rockit\Artist;

// artist
class ArtistsTableSeeder extends Seeder {

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('artists')->delete();

        Artist::create(array('id'=>'0',
                            'name' => 'Die toten Socken',
                            'short_description_de'=>'Band die nur über kleider singt ',
                            'complete_description_de'=> 'Rock band, die nur über kleider signt und zu populair ist',
                            ));
        
        Artist::create(array('id'=>'1',
                            'name' => 'Rock family',
                            'short_description_de'=>'This family really do not know aht goes about rock ',
                            'complete_description_de'=> 'Just a crazy family perfomring in the name of the Stein music',
                            ));
        
        Artist::create(array('id'=>'2',
                            'name' => 'redbulp',
                            'short_description_de'=>'New talent from Belp',
                            'complete_description_de'=> ' A new Singer that know how to sing well',
                            ));
        
       Artist::create(array('id'=>'3',
                            'name' => 'Salsa Namà',
                            'short_description_de'=>'heisse Stimmun - kühle Getränke: /n ein karibish/kubanischer Sonntag Abend für Salsa-Tänzer und solche, die es werden möchten!',
                            'complete_description_de'=> '',
                            ));
       
       Artist::create(array('id'=>'4',
                            'name' => 'Dar Vida',
                            'short_description_de'=>'16 exzellente Musiker aus verschiedenen Bands begeistern hier als Formation „Dar Vida“ = "Leben geben": heisser Latino-Sound und Mojitos für einen guten Zweck!',
                            'complete_description_de'=> '16 exzellente Musiker aus verschiedenen Bands begeistern hier als Formation „Dar Vida“ = Leben geben: der Gesamterlös kommt dem Kinderhilfswerk „ninos jugando“ zu.  Feuriger Latino-Sound und  Mojitos versprechen einen heissen Abend, und das für einen guten Zweck - sei dabei! ',
                            ));
       
       Artist::create(array('id'=>'5',
                            'name' => 'Konsi Big Band',
                            'short_description_de'=>'Konsi Big Band und Junior Big Band mit begeisterndem Repertoire!',
                            'complete_description_de'=> 'Nach der erfolgreichen Hip-Hop-CD-Taufe im Januar 2014 driftet die Konsi Bigband nun in die Gewässer des R’n’B. Am Konzert vom 11. September 2014 werden Songs von Jamiroquai, D’Angelo und Herbie Hancock von den besten SängerInnen des Konsis performt! Die Bigband knallt die Beatz n’ Hornz dazu! ',
                            ));
       
       Artist::create(array('id'=>'6',
                            'name' => 'Junior Big Band',
                            'short_description_de'=>'',
                            'complete_description_de'=> '',
                            ));
       
       Artist::create(array('id'=>'7',
                            'name' => 'Pigeons on the gate',
                            'short_description_de'=>'Pigeons on the Gate steht für einen mitreissenden, unverwechselbaren Sound, der tief im Irish Folk verwurzelt ist.',
                            'complete_description_de'=> 'Im 2011 debutierte die Band äusserst erfolgreich und überzeug mit einer Grösse und Weite, die von treibenden Beats, mystisch bis rockigen Klängen und ausdrucksstarken Stimmen getragen wird. ',
                            ));
       
       Artist::create(array('id'=>'8',
                            'name' => 'Philipp Bluedög Gerber Band',
                            'short_description_de'=>'Wer Bluesrock mit ausufernden Gitarrensoli, kernigem Gesang und treibenden Grooves liebt, der sollte sich diese Band nicht entgehen lassen.',
                            'complete_description_de'=> 'Der Solothurner Blues-Hexenmeister Philipp „Bluedög“ Gerber  genehmigt sich einen Trip in die Untiefen der wilden Siebziger und taucht gemeinsam mit dem Bassisten J.C. Wirth und dem legendären Krokus Drummer Freddy Steady  in die Freuden und Leiden des klassischen Powertrios ein. Nach unzähligen Gigs mit der Hardcore Bluesband im In- und Ausland  präsentiert sich  die Philipp Bluedög Gerber Band mit neuen eigenen Songs und einigen ausgewählten Interpreta-tionen. ',
                            ));
       
//       Artist::create(array('id'=>'6',
//                            'name' => 'Junior Big Band',
//                            'short_description_de'=>'',
//                            'complete_description_de'=> '',
//                            ));
  
//       Artist::create(array('id'=>'6',
//                            'name' => 'Junior Big Band',
//                            'short_description_de'=>'',
//                            'complete_description_de'=> '',
//                            ));

//       Artist::create(array('id'=>'6',
//                            'name' => 'Junior Big Band',
//                            'short_description_de'=>'',
//                            'complete_description_de'=> '',
//                            ));       
        
    }
}

