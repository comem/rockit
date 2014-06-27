<?php

use \Rockit\Event;

class XMLExport {

    public static function events($from, $to) {
        $filename = "events.xml";
        $xEvents = new SimpleXMLElement('<events></events>');

        $events = Event::whereNotNull("published_at")->where('start_date_hour', '>=', $from)->where('start_date_hour', '<=', $to)->orderBy('start_date_hour')->
                        with('representer', 'eventType', 'image', 'tickets.ticketCategory', 'sharings.platform', 'printings.printingType', 'performers.artist', 'performers.artist.musicians', 'staffs.member', 'staffs.skill', 'needs.skill', 'offers.gift', 'attributions.equipment')->get();

        foreach ($events as $event) {
            $xEvent = $xEvents->addChild('event');
            $xEvent->addAttribute('id', $event->id);
            $xEvent->addAttribute('event_type', $event->eventtype->name_de);
            $xEvent->addChild('start_date_hour', $event->start_date_hour);
            $xEvent->addChild('ending_date_hour', $event->ending_date_hour);
            if ($event->opening_doors != NULL) {
                $xEvent->addChild('opening_doors', $event->opening_doors);
            }
            if ($event->title_de != NULL) {
                $xEvent->addChild('title_de', $event->title_de);
            }
            if ($event->description_de != NULL) {
                $xEvent->addChild('description_de', $event->description_de);
            }
            $xEvent->addChild('nb_meal', $event->nb_meal);
            $xEvent->addChild('nb_vegans_meal', $event->nb_vegans_meal);
            if ($event->meal_notes_de != NULL) {
                $xEvent->addChild('meal_notes_de', $event->meal_notes_de);
            }
            $xEvent->addChild('nb_places', $event->nb_places);
            $xEvent->addChild('followed_by_private', $event->followed_by_private);
            if ($event->notes_de != NULL) {
                $xEvent->addChild('notes_de', $event->notes_de);
            }

            //// ARTISTS
            $xArtists = $xEvent->addChild('artists');
            $event->artists->sortByDesc(function($artist) {
                return $artist->pivot->order;
            });
            foreach ($event->artists as $artist) {
                $xArtist = $xArtists->addChild('artist');
                $xArtist->addAttribute('id', $artist->id);
                $xArtist->addAttribute('is_support', $artist->pivot->is_support);
                $xArtist->addAttribute('order', $artist->pivot->order);
                $xArtist->addChild('name', $artist->name);
                $xGenres = $xArtist->addChild('genres');
                $genres = $artist->genres;
                foreach ($genres as $genre) {
                    $xGenres->addChild('genre', $genre->name_de);
                }
                if ($artist->short_description_de != NULL) {
                    $xArtist->addChild('short_description_de', $artist->short_description_de);
                }
                if ($artist->complete_description_de != NULL) {
                    $xArtist->addChild('complete_description_de', $artist->complete_description_de);
                }
                if (count($artist->links) > 0) {
                    $xLinks = $xArtist->addChild('links');
                    foreach ($artist->links as $link) {
                        $xLink = $xLinks->addChild('link');
                        $xLink->addChild('url', $link->url);
                        $xLink->addChild('name_de', $link->name_de);
                        if (isset($link->title_de)) {
                            $xLink->addChild('title_de', $link->title_de);
                        }
                    }
                }
                if (count($artist->musicians) > 0) {
                    $musicians = $artist->musicians;
                    $lineup = "Lineup: ";
                    foreach ($musicians as $musician) {
                        if (isset($musician->stagename)) {
                            $lineup = $lineup . $musician->stagename;
                        } else {
                            $lineup = $lineup . $musician->first_name;
                            if (isset($musician->last_name)) {
                                $lineup = $lineup . " " . $musician->last_name;
                            }
                        }
                        $lineup = $lineup . ", ";
                        $instruments = $musician->instrumentsFor($artist->id)->get();
                        $indexInstr = 0;
                        foreach ($instruments as $instrument) {
                            if ($indexInstr > 0) {
                                $lineup = $lineup . "/";
                            }
                            $lineup = $lineup . $instrument->name_de;
                            $indexInstr++;
                        }
                        $lineup = $lineup . " – ";
                    }
                    $xArtist->addChild('lineup', $lineup);
                }
            }

            //// TICKETS
            $ticketCategories = $event->ticketCategories;
            $xTickets = $xEvent->addChild('tickets');
            foreach ($ticketCategories as $ticketCategory) {
                $xTicket = $xTickets->addChild('ticket');
                $xTicket->addChild('ticket_category', $ticketCategory->name_de);
                $xTicket->addChild('amount', $ticketCategory->pivot->amount);
                if ($ticketCategory->pivot->comment_de) {
                    $xTicket->addChild('comment_de', $ticketCategory->pivot->comment_de);
                }
            }

            //// REPRESENTER
            $representer = $event->representer;
            if (isset($representer)) {
                $xRepresenter = $xEvent->addChild('representer');
                $xRepresenter->addChild('first_name', $representer->first_name);
                $xRepresenter->addChild('last_name', $representer->last_name);
                if (isset($representer->email)) {
                    $xRepresenter->addChild('email', $representer->email);
                }
                if (isset($representer->phone)) {
                    $xRepresenter->addChild('phone', $representer->phone);
                }
                if (isset($representer->street)) {
                    $xRepresenter->addChild('street', $representer->street);
                }
                if (isset($representer->npa)) {
                    $xRepresenter->addChild('npa', $representer->npa);
                }
                if (isset($representer->city)) {
                    $xRepresenter->addChild('city', $representer->city);
                }
            }

            //// IMAGE SYMBOLIZATION
            $image = $event->image;
            if (isset($image)) {
                $xImage = $xEvent->addChild('image');
                $xImage->addChild('source', $image->source);
                if (isset($image->alt_de)) {
                    $xImage->addChild('alt_de', $image->alt_de);
                }
                if (isset($image->caption_de)) {
                    $xImage->addChild('caption_de', $image->caption_de);
                }
            }

            //// STAFF
            $staffs = $event->staffs;
            if(isset($staffs)) {
            $xStaffs = $xEvent->addChild('staffs');
            foreach ($staffs as $staff) {
                $xStaff = $xStaffs->addChild('staff');
                $xStaff->addChild('first_name', $staff->member->first_name);
                $xStaff->addChild('last_name', $staff->member->last_name);
                $xStaff->addChild('function', $staff->skill->name_de);
            }
            }

            //// EQUIPMENTS
            $equipments = $event->equipments;
            if (isset($equipments)) {
                $xEquipments = $xEvent->addChild('equipments');
                foreach ($equipments as $equipment) {
                    $xEquipment = $xEquipments->addChild('equipment');
                    $xEquipment->addChild('name_de', $equipment->name_de);
                    if($equipment->pivot->cost) {
                        $xEquipment->addChild('cost', $equipment->pivot->cost);
                    }
                    if($equipment->pivot->quantity) {
                        $xEquipment->addChild('quantity', $equipment->pivot->quantity);
                    }    
                }
            }

            //// GIFTS
            $gifts = $event->gifts;
            if (isset($gifts)) {
                $xGifts = $xEvent->addChild('gifts');
                foreach ($gifts as $gift) {
                    $xGift = $xGifts->addChild('gift');
                    $xGift->addChild('name_de', $gift->name_de);
                    $xGift->addChild('quantity', $gift->pivot->quantity);
                    if(isset($gift->pivot->cost)) {
                        $xGift->addChild('cost', $gift->pivot->cost);
                    }
                    if(isset($gift->pivot->comment_de)) {
                        $xGift->addChild('comment_de', $gift->pivot->comment_de);
                    }    
                }
            }
        }
        
        
        //// Prepare clean document to download and download
        // Create a new DOMDocument object to save in readable format
        $doc = new DOMDocument('1.0', 'UTF-8');
        // add spaces, new lines and make the XML more readable format
        $doc->formatOutput = true;
        // Get a DOMElement object from a SimpleXMLElement object
        $domnode = dom_import_simplexml($xEvents);
        $domnode->preserveWhiteSpace = false;
        // Import node into current document
        $domnode = $doc->importNode($domnode, true);
        // Add new child at the end of the children
        $domnode = $doc->appendChild($domnode);
        // Dump the internal XML tree back into a string
        $saveXml = $doc->saveXML();

        // Set header to output data
        header('HTTP/1.1 200 OK');
        header("Pragma: no-cache");
        header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');
        header('Content-type', 'text/xml');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        echo $saveXml;

    }

}
