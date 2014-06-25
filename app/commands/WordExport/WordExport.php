<?php

use PhpOffice\PhpWord\PhpWord,
    PhpOffice\PhpWord\IOFactory,
    \Rockit\Event;

class WordExport {

    public static function events($from, $to) {

        $word = new PhpWord();

        // Set Properties
        $properties = $word->getDocumentProperties();
        $properties->setCreator('Mahogany Hall – Konzertmanagement');
        $properties->setCompany('Mahogany Hall');
        $properties->setTitle('Events');
        $properties->setDescription('Events der Mahogany Hall Bern');
        $properties->setCategory('Events');
        $properties->setLastModifiedBy('Mahogany Hall – Konzertmanagement');
        $properties->setCreated(time());
        $properties->setModified(time());
        $properties->setSubject('Events');
        $properties->setKeywords('event, mahogany, konzert, party');

        //// Set font style definitions
        $fsH1 = array('font' => 'Arial', 'color' => '000000', 'size' => 22, 'bold' => true);
        $fsH2 = array('font' => 'Arial', 'color' => 'b2a68b', 'size' => 13, 'bold' => true, 'allCaps' => true);
        $fsH3 = array('font' => 'Arial', 'color' => '000000', 'size' => 18, 'bold' => true);
        $fsH4 = array('font' => 'Arial', 'color' => '000000', 'size' => 10, 'bold' => true);
        $fsDate = array('font' => 'Arial', 'color' => '000000', 'size' => 10, 'bold' => true);
        $fsGenre = array('font' => 'Arial', 'color' => '000000', 'size' => 10, 'bold' => true, 'italic' => true);
        $fsShortDesc = array('font' => 'Arial', 'color' => '000000', 'size' => 10, 'bold' => true);
        $fsStandard = array('font' => 'Arial', 'color' => '000000', 'size' => 10); // for complete description and other «standard» formatted texts
        $fsSmall = array('font' => 'Arial', 'color' => '0000000', 'size' => 7);
        $fsSmallBold = array('font' => 'Arial', 'color' => '0000000', 'size' => 7, 'bold' => true);

        //// Set paragraph style definitions (they do not contain font information)
        $psH1 = array('spaceBefore' => 400, 'spaceAfter' => 200, 'align' => 'left');
        $psH2 = array('spaceBefore' => 700, 'spaceAfter' => 300, 'align' => 'left');
        $psH3 = array('spaceBefore' => 700, 'spaceAfter' => 300, 'align' => 'left');
        $psH4 = array('spaceBefore' => 120, 'spaceAfter' => 60, 'align' => 'left');
        $psStandard = array('align' => 'left', 'lineHeight' => '1.2');
        $psStandardSpaceAfter = array('spaceAfter' => 200, 'align' => 'left', 'lineHeight' => '1.2');
        $psFooter = array('align' => 'left', 'lineHeight' => '1.2');


        //// Set line style definitions
        $lsSimple = array('weight' => 1, 'width' => 462, 'height' => 0); // for seperator between paragraphs
        // 1 = Main title document
        $word->addTitleStyle(1, $fsH1, $psH1);
        // 2 = title indicated dates (from-to or month)
        $word->addTitleStyle(2, $fsH2, $psH1);
        // 3 = title «event title»
        $word->addTitleStyle(3, $fsH3, $psH1);
        // 4 = small titles bold with space
        $word->addTitleStyle(4, $fsH4, $psH4);


        // create word section
        $section = $word->createSection(array('marginLeft' => 1350, 'marginRight' => 1350, 'marginTop' => 3000, 'marginBottom' => 1850,
            'footerHeight' => 700));

        // add header with logo
        $header = $section->createHeader();
        // ?CHE : should we really implement image in app?
        $header->addImage('http://mahogany.chrissharkman.ch/mahogany-pos.jpg', array('width' => 90, 'height' => 104, 'align' => 'right'));

        //// add static content to section
        $section->addText("Organisation und Lokalität:", $fsDate);
        $section->addTitle("Mahogany Hall", 1);
        $section->addText("Klösterlistutz 18, 3013 Bern – Telefon: 031 331 60 00", $fsStandard, $psStandard);
        $textrun = $section->addTextRun($psStandard);
        $textrun->addText("Reservationen: ", $fsDate);
        $textrun->addText("reservationen@mahogany.ch oder 031 331 60 00", $fsStandard);
        $textrun = $section->addTextRun($psStandardSpaceAfter);
        $textrun->addText("Kontakt: ", $fsDate);
        $textrun->addText("Konzertmanagement: Monique Sägesser, konzerte@mahogany.ch, 079 780 87 74", $fsStandard);

        $section->addLine($lsSimple);

        $section->addTitle("BAND-BILDER in 300 dpi DOWNLOAD UNTER", 4);
        $section->addText("www.mydrive.ch", $fsStandard, $psStandard);
        $section->addText("Benutzer: presse@mahog_werb", $fsStandard, $psStandard);
        $section->addText("Passwort: pressemahog11", $fsStandard, $psStandard);
        $section->addTextBreak();
        $section->addText("Es können ohne Rückfrage jeweils 1x2 Tickets verlost werden. "
                . "Für mehr Tickets bitte kurze Anfrage an konzerte@mahogany.ch. "
                . "Gewinnermeldungen von Ticketverlosungen bitte direkt an reservationen@mahogany.ch.", $fsDate, $psStandardSpaceAfter);

        $section->addLine($lsSimple);

        ////// DYNAMIC CONTENT START

        $events = Event::all();

        foreach ($events as $event) {
            echo $event . " hey";
        }






        ////// DYNAMIC CONTENT END
        // set static footer text/address/pagenumber
        $footer = $section->createFooter();
        $textrun = $footer->addTextRun($psFooter);
        $textrun->addText("Mahogany Hall Bern", $fsSmallBold);
        $textrun->addText(" • Klösterlistutz 18 • Postfach 579 • 3000 Bern 8 • Tel. +41 (0)31 331 60 00", $fsSmall);
        $footer->addText("info@mahogany.ch • konzerte@mahogany.ch • privatvanlass@mahogany.ch", $fsSmall);
        $footer->addTextBreak();
        $footer->addPreserveText('Seite {PAGE} / {NUMPAGES}', $fsSmall);
        $footer->addText("www.mahogany.ch", $fsSmallBold);

        // prepare doc for download and display «save as» dialog/or treat like browser behaviour
        $file = 'test.docx';
        WordExport::setWordHeader($file);
        $io = IOFactory::createWriter($word);
        $io->save('php://output');
    }

    private static function setWordHeader($file) {
        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="' . $file . '"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');
    }

}
