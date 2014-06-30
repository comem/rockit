<?php

use Rockit\Artist;

// artist
class ArtistsTableSeeder extends Seeder {

    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('artists')->delete();

        Artist::create(array('id'=>'9',
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
       
       
  
       Artist::create(array('id'=>'10',
                            'name' => 'Manu Hartmann Band',
                            'short_description_de'=>'',
                            'complete_description_de'=> '„…nichts für Schubladendenker und Stubenhocker….!“ Die Manu Hartmann Band sprengt musikalische Grenhzen und wagt sich mit einem Mix aus psychedelischem Soul, rotzigem Funk & schillerndem Jazz ins bunte Treiben der Ch-Musikszene. Voran steht die ausdrucksstarke Stimme der Sängerin Manu Hartmann, die den Songs mal sanft, mal rauh, ihren eigenwilligen Stempel aufsetzt. ',
                            ));

       Artist::create(array('id'=>11,
                            'name' => 'Andy Trinkler & Border Affair',
                            'short_description_de'=>'',
                            'complete_description_de'=> '',
                            ));       
        
       Artist::create(array('id'=>'12',
                            'name' => 'SPAN',
                            'short_description_de'=>'Die Gallionsfiguren des Bärner Mundartrock im traditionsreichsten Musicclub Berns!',
                            'complete_description_de'=> 'Letztes Jahr kehrten Span zurück und überraschten mit ihrem kraftvollen neuen Studio-Album „Rock&Roll Härz“. Wohlverstanden: Sie waren nie weg. Als einzige Schweizer Rock Band blieben Span vier Dekaden lang mit nur wenigen Personalwechseln zusammen und eine Alternative zum Rock’n’Roll ihrer Band gab es für sie nie. Und so tun die vier Berner auch nach Tausenden von Gigs immer noch das, was sie am liebsten tun und am besten können: Spielen, spielen, spielen und nach wie vor ihre Anhänger begeistern!',
                            ));       
       
       Artist::create(array('id'=>13,
                            'name' => 'Sarah Chaksad Orchestra',
                            'short_description_de'=>'Sarah Chaksad beweist ihre Virtuosität, Vielseitigkeit und Kreativität mit ihrem Orchestra!',
                            'complete_description_de'=> 'Anfang November 2012 begannen die ersten Proben mit Sarah Chaksads neustem Projekt, einem 13-köpfigen Jazz Orchestra. Im Zentrum der Musik stehen die Solisten und Solistinnen, die immer Teil des Gesamtablauf eines Stückes sind und mit ihrem Spiel die Kompositionen massgeblich mitgestalten. Häufig verarbeitet Sarah Chaksad in ihren Stücken autobiographische Erlebnisse, mit einem feinen Gespür für Harmonie und einem kreativen Umgang mit Rhythmen. In der Mahogany ist sie regelmässig zu Gast mit ihrer Band „Neighbourhood“, wo sie mit ihren Eigenkompositionen RnB-, Hip Hop- und Soul–Anhänger zu begeistern weiss. Hier zeigt uns diese aussergewöhnliche und engagierte junge Künstlerin weitere Facetten ihres Wirkens. ',
                            ));       
       
       Artist::create(array('id'=>'14',
                            'name' => 'Naked Soul',
                            'short_description_de'=>'Das Powerquartett Naked Soul zeigt, dass eine Akustikband nicht unbedingt leise sein muss.',
                            'complete_description_de'=> 'Ihr sehr abwechslungsreiches Programm beinhaltet Hits der letzten 50 Jahre, aber auch Eigenkompositionen. Ob Rock, Pop, Funk, Balladen, Reggae oder Rock n’ Roll; es ist von allem etwas dabei. Mit mehrstimmigem Gesang, virtuosen Gitarrensolos und auch mal einer Tanzeinlage wird Unterhaltung pur geboten.',
                            ));       
       
       Artist::create(array('id'=>'15',
                            'name' => 'Chicago Hot Six',
                            'short_description_de'=>'Die Renaissance des Chicago Jazz!',
                            'complete_description_de'=> 'Hier wird die Renaissance des Chicago Jazz virtuos zelebriert – ein Muss für alle Fans dieser Stilrichtung ! ',
                            ));
       
//       Artist::create(array('id'=>'',
//                            'name' => '',
//                            'short_description_de'=>'',
//                            'complete_description_de'=> '',
//                            ));       
       
    }
}

