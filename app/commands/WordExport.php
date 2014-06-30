<?php

use PhpOffice\PhpWord\PhpWord,
    PhpOffice\PhpWord\IOFactory,
    \Rockit\Event;

/**
 * This class is used to export an interval of selected Event into a well-formatted Word file.
 * 
 * @author Christian Heimann <christian.heimann@heig-vd.ch>
 */
class WordExport {

    /**
     * Return a Word file containing data from the events filtered by the <b>from</b> and <b>to</b> attribute.<br>
     * 
     * The <b>from</b> and <b>to</b> attribute must be UTC datetime formatted with the 'YYYY-mm-DD hh:mm:ss' format.<br>
     * They are mandatory and will set a time interval from which the events will be retrieved and returned.<br>
     * 
     * @param DateTime $from The interval beginning time
     * @param DateTime $to The interval end time
     * @return Word An output to download the created Word file
     */
    public static function events($from, $to) {
        setlocale(LC_ALL, 'de_DE@euro', 'de_DE', 'de', 'ge');
        header('Content-Type: text/html; charset=utf-8');

        // Default values
        $defFontType = 'Arial';
        $defFontColor = '000000';
        $defFontSize = 9;
        $defLineHeight = '1.1';
        $filename = "events.docx";

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
        $fsH1 = array('font' => $defFontType, 'color' => $defFontColor, 'size' => 22, 'bold' => true);
        $fsH2 = array('font' => $defFontType, 'color' => 'b2a68b', 'size' => 12, 'bold' => true);
        $fsH3 = array('font' => $defFontType, 'color' => $defFontColor, 'size' => 18, 'bold' => true);
        $fsH4 = array('font' => $defFontType, 'color' => $defFontColor, 'size' => 12, 'bold' => true);
        $fsDate = array('font' => $defFontType, 'color' => $defFontColor, 'size' => 12, 'bold' => true);
        $fsGenre = array('font' => $defFontType, 'color' => $defFontColor, 'size' => $defFontSize, 'bold' => true, 'italic' => true);
        $fsShortDesc = array('font' => $defFontType, 'color' => $defFontColor, 'size' => $defFontSize, 'bold' => true);
        $fsStandard = array('font' => $defFontType, 'color' => $defFontColor, 'size' => $defFontSize); // for complete description and other «standard» formatted texts
        $fsItalic = array('font' => $defFontType, 'color' => $defFontColor, 'size' => $defFontSize, 'italic' => true);
        $fsSmall = array('font' => $defFontType, 'color' => $defFontColor, 'size' => 7);
        $fsSmallBold = array('font' => $defFontType, 'color' => $defFontColor, 'size' => 7, 'bold' => true);

        //// Set paragraph style definitions (they do not contain font information)
        $psH1 = array('spaceBefore' => 200, 'spaceAfter' => 100, 'align' => 'left');
        $psH2 = array('spaceBefore' => 150, 'spaceAfter' => 200, 'align' => 'left');
        $psH3 = array('spaceBefore' => 120, 'spaceAfter' => 20, 'align' => 'left', 'keepNext' => true);
        $psH4 = array('spaceBefore' => 120, 'spaceAfter' => 60, 'align' => 'left');
        $psStandard = array('align' => 'left', 'lineHeight' => $defLineHeight);
        $psStandardkeepNext = array('align' => 'left', 'lineHeight' => '1.1', 'keepNext' => true);
        $psStandardSpaceAfter = array('spaceAfter' => 140, 'align' => 'left', 'lineHeight' => $defLineHeight);
        $psStandardSpaceBefore = array('spaceBefore' => 120, 'align' => 'left', 'lineHeight' => $defLineHeight);
        $psStandardSpaceBeforeAndAfter = array('spaceBefore' => 120, 'spaceAfter' => 180, 'align' => 'left', 'lineHeight' => $defLineHeight);
        $psFooter = array('align' => 'left', 'lineHeight' => $defLineHeight);


        //// Set line style definitions
        $lsSimple = array('weight' => 1, 'width' => 460, 'height' => 0); // for seperator between paragraphs
        $lsColor = array('weight' => 1, 'width' => 460, 'height' => 0, 'color' => '#b2a68b'); // for colored seperator line between paragraphs

        // 1 = Main title document
        $word->addTitleStyle(1, $fsH1, $psH1);
        // 2 = title indicated global dates (from-to or month)
        $word->addTitleStyle(2, $fsH2, $psH2);
        // 3 = title «event title»
        $word->addTitleStyle(3, $fsH3, $psH3);
        // 4 = small titles bold with space
        $word->addTitleStyle(4, $fsH4, $psH4);


        // create word section
        $section = $word->createSection(array('marginLeft' => 1350, 'marginRight' => 1350, 'marginTop' => 3000, 'marginBottom' => 1650,
            'footerHeight' => 400));

        // add header with logo
        $header = $section->createHeader();
        $header->addImage('public/images/mahogany-pos.jpg', array('width' => 90, 'height' => 104, 'align' => 'right'));

        //// add static content to section
        $section->addText("Organisation und Lokalität:", $fsShortDesc);
        $section->addTitle("Mahogany Hall", 1);
        $section->addText("Klösterlistutz 18, 3013 Bern – Telefon: 031 331 60 00", $fsStandard, $psStandard);
        $textrun = $section->addTextRun($psStandard);
        $textrun->addText("Reservationen: ", $fsShortDesc);
        $textrun->addText("reservationen@mahogany.ch oder 031 331 60 00", $fsStandard);
        $textrun = $section->addTextRun($psStandardSpaceAfter);
        $textrun->addText("Kontakt: ", $fsShortDesc);
        $textrun->addText("Konzertmanagement: Monique Sägesser, konzerte@mahogany.ch, 079 780 87 74", $fsStandard);

        $section->addLine($lsSimple);

        $section->addTitle("BAND-BILDER in 300 dpi DOWNLOAD UNTER", 4);
        $section->addText("www.mydrive.ch", $fsStandard, $psStandard);
        $section->addText("Benutzer: presse@mahog_werb", $fsStandard, $psStandard);
        $section->addText("Passwort: pressemahog11", $fsStandard, $psStandardSpaceAfter);
        $section->addText("Es können ohne Rückfrage jeweils 1x2 Tickets verlost werden. "
        . "Für mehr Tickets bitte kurze Anfrage an konzerte@mahogany.ch. "
        . "Gewinnermeldungen von Ticketverlosungen bitte direkt an reservationen@mahogany.ch.", $fsShortDesc, $psStandardSpaceAfter);

        $section->addLine($lsColor);

        ////// DYNAMIC CONTENT START

        $timeFrom = strtotime($from);
        $timeTo = strtotime($to);
        // test if it is a whole month:
        if (self::isWholeMonth($timeFrom, $timeTo)) {
            $section->addTitle("Konzerte im " . strftime("%B %Y", $timeFrom), 2);
        } else {
            $dates = "Konzerte vom " . strftime("%e. %B %Y", $timeFrom) . " bis " . strftime("%e. %B %Y", $timeTo);
            $dates = self::deleteDoubleWhitspace($dates);
            $section->addTitle($dates, 2);
        }
        $section->addLine($lsColor);

        // Events listing loop
        $events = Event::whereNotNull("published_at")->where('start_date_hour', '>=', $from)->where('start_date_hour', '<=', $to)->orderBy('start_date_hour')->get();
        foreach ($events as $event) {
            $date = strftime("%A, %e. %B %Y  |  %H.%M Uhr", strtotime($event->start_date_hour));
            $date = self::deleteDoubleWhitspace($date);

            if ($event->opening_doors != NULL) {
                $opening_doors = strftime("  (Türöffnung %H.%M Uhr)", strtotime($event->opening_doors));
            } else {
                $opening_doors = "";
            }
            $textrun = $section->addTextRun($psStandard);
            $textrun->addText($date, $fsDate);
            $textrun->addText($opening_doors, $fsStandard);

            $artists = $event->artists->sortByDesc(function($artist) {
                return $artist->pivot->order;
            });
            $mainArtists = $artists->filter(function($artist) {
                return $artist->pivot->is_support == 0;
            })->sortByDesc(function($artist){
                return $artist->pivot->order;
            });

            ////  case 1: artistListingStandard: event has no title_de
            if ($event->title_de == NULL) {
                if ($event->description_de != NULL) {
                    $section->addText($event->description_de, $fsStandard, $psStandardSpaceBeforeAndAfter);
                }
                foreach ($artists as $artist) {
                    if ($artist->pivot->is_support == 0) {
                        $section->addTitle($artist->name, 3);
                    } else {
                        $section->addTitle("Support: " . $artist->name, 4);
                    }
                    $trgenres = $section->addTextRun($psStandardSpaceAfter);
                    $index = 0;
                    foreach ($artist->genres as $genre) {
                        if ($index > 0) {
                            $trgenres->addText(" / ");
                        }
                        $trgenres->addText($genre->name_de, $fsGenre);
                        $index++;
                    }
                    $section->addText($artist->short_description_de, $fsShortDesc, $psStandard);
                    $section->addText($artist->complete_description_de, $fsStandard, $psStandard);
                    if (count($artist->musicians) > 0) {
                        $trLineup = $section->addTextRun($psStandard);
                        $trLineup->addText("Lineup:", $fsItalic);
                        $indexMusician = 0;
                        foreach ($artist->musicians as $musician) {
                            if ($indexMusician > 0) {
                                $trLineup->addText(",", $fsItalic);
                            }
                            if (isset($musician->stagename)) {
                                $trLineup->addText(" " . $musician->stagename, $fsItalic);
                            } else {
                                $trLineup->addText(" " . $musician->first_name, $fsItalic);
                                if (isset($musician->last_name)) {
                                    $trLineup->addText(" " . $musician->last_name, $fsItalic);
                                }
                            }
                            $trLineup->addText(" ");
                            $indexInstr = 0;
                            foreach ($musician->instrumentsFor($artist->id)->get() as $instrument) {
                                if ($indexInstr > 0) {
                                    $trLineup->addText("/", $fsItalic);
                                }
                                $trLineup->addText($instrument->name_de, $fsItalic);
                                $indexInstr++;
                            }
                            $indexMusician++;
                        }
                    }
                    // if artist has no link, then add artists representer if there is one
                    if (count($artist->links) > 0) {
                        $trLinks = $section->addTextRun($psStandard);
                        $indexLinks = 0;
                        foreach ($artist->links as $link) {
                            if ($indexLinks > 0) {
                                $trLinks->addText(", ", $fsStandard);
                            }
                            $trLinks->addText($link->url, $fsStandard);
                            $indexLinks++;
                        }
                    } elseif ($event->representer != NULL) {
                        $contactDetails = self::getRepresenterDetails($event->representer);
                        $trContact = $section->addTextRun($psStandard);
                        $trContact->addText("Bandkontakt: " . $contactDetails, $fsStandard);
                    }
                }
            }
            //// case 2: artistListingSingle: event has a title_de and only one main artist
            elseif ($event->title_de != NULL && count($mainArtists) < 2) {
                $section->addTitle($event->title_de, 3);
                $trgenres = $section->addTextRun($psStandardSpaceAfter);
                $index = 0;
                foreach($mainArtists as $artist) {
                    foreach ($artist->genres as $genre) {
                        if ($index > 0) {
                            $trgenres->addText(" / ");
                        }
                        $trgenres->addText($genre->name_de, $fsGenre);
                        $index++;
                    }
                }
                $section->addText($event->description_de, $fsStandard, $psStandardSpaceAfter);
                foreach($mainArtist as $artist) {
                    $section->addText($artist->short_description_de, $fsShortDesc, $psStandard);
                    $section->addText($artist->complete_description_de, $fsStandard, $psStandard);
                    if (count($artist->musicians) > 0) {
                        $trLineup = $section->addTextRun($psStandard);
                        $trLineup->addText("Lineup:", $fsItalic);
                        $indexMusician = 0;
                        foreach ($artist->musicians as $musician) {
                            if ($indexMusician > 0) {
                                $trLineup->addText(",", $fsItalic);
                            }
                            if (isset($musician->stagename)) {
                                $trLineup->addText(" " . $musician->stagename, $fsItalic);
                            } else {
                                $trLineup->addText(" " . $musician->first_name, $fsItalic);
                                if (isset($musician->last_name)) {
                                    $trLineup->addText(" " . $musician->last_name, $fsItalic);
                                }
                            }
                            $trLineup->addText(" ");
                            $indexInstr = 0;
                            foreach ($musician->instrumentsFor($artist->id)->get() as $instrument) {
                                if ($indexInstr > 0) {
                                    $trLineup->addText("/", $fsItalic);
                                }
                                $trLineup->addText($instrument->name_de, $fsItalic);
                                $indexInstr++;
                            }
                            $indexMusician++;
                        }
                    }
                }
                $supportArtists = $artists->filter(function($artist) {
                    return $artist->pivot->is_support == 1;
                });
                foreach($supportArtists as $artist) {
                    $section->addTitle("Support: " . $artist->name, 4);
                    $trgenres = $section->addTextRun($psStandardSpaceAfter);
                    $index = 0;
                    foreach ($artist->genres as $genre) {
                        if ($index > 0) {
                            $trgenres->addText(" / ");
                        }
                        $trgenres->addText($genre->name_de, $fsGenre);
                        $index++;
                    }
                    $section->addText($artist->short_description_de, $fsShortDesc, $psStandard);
                    $section->addText($artist->complete_description_de, $fsStandard, $psStandard);
                    if (count($artist->musicians) > 0) {
                        $trLineup = $section->addTextRun($psStandard);
                        $trLineup->addText("Lineup:", $fsItalic);
                        $indexMusician = 0;
                        foreach ($artist->musicians as $musician) {
                            if ($indexMusician > 0) {
                                $trLineup->addText(",", $fsItalic);
                            }
                            if (isset($musician->stagename)) {
                                $trLineup->addText(" " . $musician->stagename, $fsItalic);
                            } else {
                                $trLineup->addText(" " . $musician->first_name, $fsItalic);
                                if (isset($musician->last_name)) {
                                    $trLineup->addText(" " . $musician->last_name, $fsItalic);
                                }
                            }
                            $trLineup->addText(" ");
                            $indexInstr = 0;
                            foreach ($musician->instrumentsFor($artist->id)->get() as $instrument) {
                                if ($indexInstr > 0) {
                                    $trLineup->addText("/", $fsItalic);
                                }
                                $trLineup->addText($instrument->name_de, $fsItalic);
                                $indexInstr++;
                            }
                            $indexMusician++;
                        }
                    }
                    // if artist has no link, then add artists representer if there is one
                    if (count($artist->links) > 0) {
                        $trLinks = $section->addTextRun($psStandard);
                        $indexLinks = 0;
                        foreach ($artist->links as $link) {
                            if ($indexLinks > 0) {
                                $trLinks->addText(", ", $fsStandard);
                            }
                            $trLinks->addText($link->url, $fsStandard);
                            $indexLinks++;
                        }
                    } elseif ($event->representer != NULL) {
                        $contactDetails = self::getRepresenterDetails($event->representer);
                        $trContact = $section->addTextRun($psStandard);
                        $trContact->addText("Bandkontakt: " . $contactDetails, $fsStandard);
                    }
                }
            }
            //// case 3: artistListingMulti: event has a title_de and multiple main artists
            elseif ($event->title_de != NULL && count($mainArtists) > 1) {
                $section->addTitle($event->title_de, 3);
                $trgenres = $section->addTextRun($psStandardSpaceAfter);
                $index = 0;
                foreach($artists as $artist) {
                    foreach ($artist->genres as $genre) {
                        if ($index > 0) {
                            $trgenres->addText(" / ");
                        }
                        $trgenres->addText($genre->name_de, $fsGenre);
                        $index++;
                    }
                }
                $section->addText($event->description_de, $fsStandard, $psStandardSpaceAfter);
                foreach($mainArtist as $artist) {
                    $section->addText($artist->name . ": " . $artist->short_description_de, $fsShortDesc, $psStandard);
                    $section->addText($artist->complete_description_de, $fsStandard, $psStandard);
                    if (count($artist->musicians) > 0) {
                        $trLineup = $section->addTextRun($psStandard);
                        $trLineup->addText("Lineup:", $fsItalic);
                        $indexMusician = 0;
                        foreach ($artist->musicians as $musician) {
                            if ($indexMusician > 0) {
                                $trLineup->addText(",", $fsItalic);
                            }
                            if (isset($musician->stagename)) {
                                $trLineup->addText(" " . $musician->stagename, $fsItalic);
                            } else {
                                $trLineup->addText(" " . $musician->first_name, $fsItalic);
                                if (isset($musician->last_name)) {
                                    $trLineup->addText(" " . $musician->last_name, $fsItalic);
                                }
                            }
                            $trLineup->addText(" ");
                            $indexInstr = 0;
                            foreach ($musician->instrumentsFor($artist->id)->get() as $instrument) {
                                if ($indexInstr > 0) {
                                    $trLineup->addText("/", $fsItalic);
                                }
                                $trLineup->addText($instrument->name_de, $fsItalic);
                                $indexInstr++;
                            }
                            $indexMusician++;
                        }
                    }
                }
                $supportArtists = $artists->filter(function($artist) {
                    return $artist->pivot->is_support == 1;
                });
                foreach($supportArtists as $artist) {                    
                    $section->addText("Support: " . $artist->name . ": " . $artist->short_description_de, $fsShortDesc, $psStandard);
                    $section->addText($artist->complete_description_de, $fsStandard, $psStandard);
                    if (count($artist->musicians) > 0) {
                        $trLineup = $section->addTextRun($psStandard);
                        $trLineup->addText("Lineup:", $fsItalic);
                        $indexMusician = 0;
                        foreach ($artist->musicians as $musician) {
                            if ($indexMusician > 0) {
                                $trLineup->addText(",", $fsItalic);
                            }
                            if (isset($musician->stagename)) {
                                $trLineup->addText(" " . $musician->stagename, $fsItalic);
                            } else {
                                $trLineup->addText(" " . $musician->first_name, $fsItalic);
                                if (isset($musician->last_name)) {
                                    $trLineup->addText(" " . $musician->last_name, $fsItalic);
                                }
                            }
                            $trLineup->addText(" ");
                            $indexInstr = 0;
                            foreach ($musician->instrumentsFor($artist->id)->get() as $instrument) {
                                if ($indexInstr > 0) {
                                    $trLineup->addText("/", $fsItalic);
                                }
                                $trLineup->addText($instrument->name_de, $fsItalic);
                                $indexInstr++;
                            }
                            $indexMusician++;
                        }
                    }
                    // if artist has no link, then add artists representer if there is one
                    if (count($artist->links) > 0) {
                        $trLinks = $section->addTextRun($psStandard);
                        $indexLinks = 0;
                        foreach ($artist->links as $link) {
                            if ($indexLinks > 0) {
                                $trLinks->addText(", ", $fsStandard);
                            }
                            $trLinks->addText($link->url, $fsStandard);
                            $indexLinks++;
                        }
                    } elseif ($event->representer != NULL) {
                        $contactDetails = self::getRepresenterDetails($event->representer);
                        $trContact = $section->addTextRun($psStandard);
                        $trContact->addText("Bandkontakt: " . $contactDetails, $fsStandard);
                    }
                }   
            }
            //// END cases 1 to 3

            $trTickets = $section->addTextRun($psStandardSpaceBeforeAndAfter);
            $indexTickets = 0;
            foreach ($event->ticketCategories as $ticket) {
                if ($indexTickets > 0) {
                    $trTickets->addText(" / ");
                } else {
                    $trTickets->addText("CHF ");
                }
                if ($ticket->pivot->comment_de != NULL) {
                    $comment = " " . $ticket->pivot->comment_de;
                } else {
                    $comment = "";
                }
                $trTickets->addText($ticket->pivot->amount . ".–" . $comment, $fsStandard);
                $indexTickets++;
            }
            $section->addLine($lsSimple);
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
        self::setWordHeader($filename);
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

    private static function isWholeMonth($timeFrom, $timeTo) {
        $isWholeMonth = false;
        if (date('n', $timeFrom) == date('n', $timeTo) && date('Y', $timeFrom) == date('Y', $timeTo) && date('j', $timeFrom) == 1 && date('j', $timeTo) == date('t', $timeFrom)) {
            $isWholeMonth = true;
        }
        return $isWholeMonth;
    }

    private static function getRepresenterDetails($representer) {
        $contact = "";
        if ($representer != NULL) {
            $contact = $contact . $representer->first_name . " " . $representer->last_name;
            if ($representer->phone != NULL) {
                $contact = $contact . ", Tel. " . $representer->phone;
            }
            if ($representer->email != NULL) {
                $contact = $contact . ", " . $representer->email;
            }
        }
        return $contact;
    }

    public static function deleteDoubleWhitspace($date) {
        $date = preg_replace("/\s\s(\d\.)/", " $1", $date);
        return $date;
    }

}
