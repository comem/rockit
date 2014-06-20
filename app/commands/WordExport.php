<?php

require_once dirname(__FILE__) . '/../PhpOffice/PHPWord.php';

class WordExport {

    public static function events($from, $to) {

        $word = new PhpWord();

        // Set Properties
        $properties = $word->getProperties();
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

        // Set style definitions: ts = title styles, fs = font styles, ps = paragraph styles
        $tsH1 = array('color' => '000000', 'size' => 22, 'bold' => true);
        $tsH2 = array('color' => '000000', 'size' => 18, 'bold' => true);
        $tsH3 = array('color' => '000000', 'size' => 14, 'bold' => true);
        $fsDate = array('color' => '000000', 'size' => 10, 'bold' => true);
        $fsGenre = array('color' => '000000', 'size' => 10, 'bold' => true);
        // Set paragraph definitions (they don't contain font information)
        $psTitles = array('spaceBefore'=>700, 'spaceAfter' => 300, 'align' => 'right');


        $content = $word->createSection();
        $content->addTitle("Title here", $tsH1, $psTitles);
        $content->addText("helloooo", $fsDate, $psTitles);
        $content->addText("secondline", $fsGenre);
        
        // prepare doc for download and display «save as» dialog
        $file = 'test.docx';
        setWordHeader($file);
        $io = PhpOffice\PhpWord\IOFactory::createWriter($word);
        $io->save('php://output');
    }

    function setWordHeader($file) {
        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="' . $file . '"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');
    }

}
