<?php

use PhpOffice\PhpWord\PhpWord,
 PhpOffice\PhpWord\IOFactory;

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
        $fsDate = array('font' => 'Arial', 'color' => '000000', 'size' => 10, 'bold' => true);
        $fsGenre = array('font' => 'Arial', 'color' => '000000', 'size' => 10, 'bold' => true);
        
        //// Set paragraph style definitions (they don't contain font information)
        $psH1 = array('spaceBefore'=> 700, 'spaceAfter' => 300, 'align' => 'left');
        $psH2 = array('spaceBefore'=> 700, 'spaceAfter' => 300, 'align' => 'left');
        $psH3 = array('spaceBefore'=> 700, 'spaceAfter' => 300, 'align' => 'left');


        
        
        // 1 = Main title document
        $word->addTitleStyle(1, $fsH1, $psH1);
        // 2 = title dates (from to/month)
        $word->addTitleStyle(2, $fsH2, $psH1);
        // 3 = title «event title»
        $word->addTitleStyle(3, $fsH3, $psH1);
        
        
        
        
        
        $content = $word->createSection(array('marginLeft'=>1350, 'marginRight'=>1350, 'marginTop'=>3000, 'marginBottom'=>1350));
        
        
        
        $content->addTitle("Title here", 1);

        $content->addText("helloooo", $fsDate);
        $content->addText("secondline", $fsGenre);
        $content->addTitle("Konzerte im November", 2);
        $content->addTitle("Pandorra", 3);
        $content->addText("Short description");
        

        
        // prepare doc for download and display «save as» dialog
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
