<?php

/*
 * Success messages
 * Syntax :
 * 'created' : "Der/Die/Das neue ... wurde gespeichert."
 * 'updated' : "Der/Die/Das ... wurde aktualisiert."
 * 'deleted' : "Der/Die/Das ... wurde gelöscht."
 * 'restored' : "Der/Die/Das ... wurde wiederhergestellt."
 */

return [
    'artist' => [
        'created' => "Neuer Künstler \":name\" wurde gespeichert.",
        'deleted' => "Künstler\":name\" wurde gelöscht.",
        'updated' => "Künstler \":name\" wurde aktualisiert.",
    ],
    'attribution' => [
        'created' => "Neue Zuweisung wurde gespeichert.",
        'updated' => "Zuweisung wurde aktualisiert.",
        'deleted' => "Zuweisung wurde gelöscht.",
    ],
    'auth' => [
        'login' => "Sie sind jetzt eingeloggt.",
        'logout' => "Sie sind jetzt ausgeloggt.",
    ],
    'description' => [
        'created' => "Genre wurde dem Künstler hinzugefügt.",
        'deleted' => "Genre wurde vom Künstler entfernt.",
    ],
    'equipment' => [
        'deleted' => "Equipment \":name\" wurde gelöscht.",
        'restored' => "Equipment \":name\" wurde wiederhergestellt.",
        'created' => "Equipment \":name\" wurde gespeichert.",
    ],
    'event' => [
        'updated' => "Event \":name\" wurde aktualisiert.",
        'created' => "Neuer Event \":name\" wurde gespeichert.",
        'deleted' => "Event \":name\" wurde gelöscht.",
        'published' => "Event ist jetzt freigegeben.",
        'unpublished' => "Event ist nicht mehr freigegeben.",
    ],
    'event_type' => [
        'created' => "Neuer Eventtyp \":name\" wurde gespeichert.",
        'deleted' => "Eventtyp \":name\" wurde gelöscht.",
        'restored' => "Eventtyp \":name\" wurde wiederhergestellt.",
    ],
    'file' => [
        'deleted' => "Datei \":file\" wurde gelöscht.",
        'uploaded' => "Datei \":file\" wurde gespeichert.",
    ],
    'fulfillment' => [
        'created' => "Kompetenz wurde zugewiesen.",
        'deleted' => "Zugewiesene Kompetenz wurde entfernt.",
    ],
    'genre' => [
        'deleted' => "Genre \":name\" wurde gelöscht.",
        'created' => "Genre \":name\" wurde gespeichert.",
        'restored' => "Genre \":name\" wurde wiederhergestellt.",
    ],
    'gift' => [
        'created' => "Preis \":name\" wurde gespeichert.",
        'deleted' => "Preis \":name\" wurde gelöscht.",
        'restored' => "Preis \":name\" wurde wiederhergestellt.",
    ],
    'guarantee' => [
        'created' => "Künstler-Vertreter \":name\" wurde mit Event vernküpft.",
        'deleted' => "Vernküpfung von Künstler-Vertreter \":name\" mit Event wurde entfernt.",
    ],
    'illustration' => [
        'created' => "Bild wurde mit Künstler vernküpft.",
        'deleted' => "Verknüpfung von Bild mit Künstler wurde entfernt.",
    ],
    'image' => [
        'created' => "Neues Bild wurde gespeichert.",
        'deleted' => "Bild wurde gelöscht.",
        'updated' => "Bild wurde aktualisiert.",
    ],
    'instrument' => [
        'created' => "Neues Instrument \":name\" wurde gespeichert.",
        'deleted' => "Instrument \":name\" wurde gelöscht.",
        'restored' => "Instrument \":name\" wurde wiederhergestellt.",
    ],
    'lineup' => [
        'created' => "Lineup-Eintrag wurde gespeichert.",
        'deleted' => "Lineup-Eintrag wurde gelöscht.",
    ],
    'link' => [
        'deleted' => "Link wurde gelöscht.",
        'created' => "Neuer Link \":name\" wurde gespeichert.",
        'updated' => "Link \":name\" wurde aktualisiert.",
    ],
    'member' => [
        'created' => "Mitglied \":name\" wurde gespeichert.",
        'updated' => "Mitglied \":name\" wurde aktualisiert.",
        'deleted' => "Mitglied \":name\" wurde gelöscht.",
    ],
    'musician' => [
        'deleted' => "Musiker \":name\" wurde gelöscht.",
        'created' => "Neuer Musiker \":name\" wurde gespeichert.",
        'updated' => "Musiker \":name\" wurde aktualisiert.",
    ],
    'need' => [
        'created' => "Neuer Bedarf für Event wurde gespeichert.",
        'updated' => "Bedarf wurde aktualisiert.",
        'deleted' => "Bedarf wurde gelöscht.",
    ],
    'offer' => [
        'created' => "Verlosungs-Angebot wurde gespeichert.",
        'updated' => "Verlosungs-Angebot wurde aktualisiert.",
        'deleted' => "Verlosungs-Angebot wurde gelöschte.",
    ],
    'performer' => [
        'created' => "Der Künstler wurde mit dem Event verknüpft.",
        'updated' => "Die Performance des Künstlers wurde aktualisiert.",
        'deleted' => "Die Verknüpfung des Künstlers mit dem Event wurde gelöscht.",
    ],
    'printing' => [
        'created' => "Druckauftrag wurde dem Event zugewiesen.",
        'updated' => "Druckauftrag wurde aktualisiert.",
        'deleted' => "Druckauftrag wurde gelöscht.",
    ],
    'printing_type' => [
        'created' => "Neuer Druckprodukttyp \":name\" wurde gespeichert.",
        'deleted' => "Druckprodukttyp \":name\" wurde gelöscht.",
        'restored' => "Druckprodukttyp \":name\" wurde wiederhergestellt.",
    ],
    'representer' => [
        'created' => "Neuer Künstler-Vertreter \":name\" wurde gespeichert.",
        'updated' => "Künstler-Vertreter \":name\" wurde aktualisiert.",
        'deleted' => "Künstler-Vertreter \":name\" wurde gelöscht.",
        'restored' => "Künstler-Vertreter \":name\" wurde wiederhergestellt.",
    ],
    'sharing' => [
       'created' => "Mitteilung wurde gespeichert und gepostet.",
       'deleted' => "Mitteilung \":name\" wurde gelöscht.",
    ],
    'skill' => [
        'deleted' => "Funktion \":name\" wurde gelöscht.",
        'restored' => "Funktion \":name\" wurde wiederhergestellt.",
        'created' => "Neue Funktion \":name\" wurde gespeichert.",
    ],
    'staff' => [
        'created' => "Funktion wurde dem Mitglied für Event zugewiesen.",
        'updated' => "Funktion des Mitglieds für Event wurde aktualisiert.",
        'deleted' => "Funktion des Mitglieds für Event wurde gelöscht.",
    ],
    'symbolization' => [
        'created' => "Bild wurde mit Event verknüpft.",
        'deleted' => "Verknüpfung von Bild mit Event wurde entfernt.",
    ],
    'ticket' => [
        'created' => "Neues Ticket wurde gespeichert.",
        'updated' => "Ticket wurde aktualisiert.",
        'deleted' => "Ticket wurde gelöscht.",
    ],
    'ticket_category' => [
        'created' => "Neue Ticketkategorie \":name\" wurde gespeichert.",
        'deleted' => "Ticketkategorie \":name\" wurde gelöscht.",
        'restored' => "Ticketkategorie \":name\" wurde wiederhergestellt.",
    ],
    'user' => [
        'updated' => "Benutzer wurde aktualisiert."
    ],
];
