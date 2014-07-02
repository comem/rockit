<?php

/*
 * Fail messages in german
 */

return [
    'acl' => "Sie sind für diese Aktion nicht authentifiziert.",
    'artist' => [
        'inexistant' => "Keinen entsprechenden Künstler gefunden.",
        'nogenre' => "Kein gültiges Genre für Künstler gefunden.",
        'genre' => "Genre :key existiert nicht.",
        'image' => "Bild :key existiert nicht oder ist nicht verfügbar (z.B. mit anderem Künstler verlinkt).",
    ],
    'attribution' => [
        'existing' => "Entsprechende Zuweisung existiert bereits.",
        'inexistant' => "Keine entsprechende Zuweisung gefunden.",
        'not_unique' => "Doppel in Zuweisung!",
    ],
    'auth' => "Sie müssen angemeldet sein um die Aktion ausführen zu können.",
    'description' => [
        'existing' => "Künstler ist bereits mit dem Genre verknüpft.",
        'inexistant' => "Keine entsprechende Beschreibung gefunden.",
        'last_genre' => "Ein Künstler verlangt mindestens ein Genre, daher können Sie das Genre nicht löschen.",
    ],
    'empty_data' => "Keine Inhalte zu aktualisieren.",
    'equipment' => [
        'existing' => "Equipment \":name\" existiert bereits.",
        'inexistant' => "Kein entsprechendes Equipment gefunden.",
    ],
    'event' => [
        'overlap' => "Event überschneidet sich mit bestehendem Event.",
        'existing' => "Event \":name\" existiert bereits.",
        'inexistant' => "Keinen entsprechenden Event gefunden.",
        'at_least_one_main_performer' => "Event muss mindestens einen Haupt-Künstler haben.",
        'is_symbolized' => "Event muss ein zugewiesenes Bild haben.",
        'is_not_published' => "Event muss freigegeben sein, damit eine automatische Mitteilung erstellt werden kann.",
    ],
    'event_type' => [
        'existing' => "Eventtyp \":name\" existiert bereits.",
        'inexistant' => "Keinen entsprechenden Eventtyp gefunden.",
    ],
    'export' => [
        'no_input' => "Daten von/bis nicht gefunden.",
        'unchronological' => "Daten sind chronologisch nicht korrekt.",
    ],
    'file' => [
        'invalid' => "Ausgewählte Datei ist nicht gültig.",
        'inexistant' => "Datei \":file\" konnte nicht gefunden werden.",
    ],
    'file_type' => [
        'unsupported' => "Datei vom Typ (:type) kann nicht gespeichert werden.",
    ],
    'fulfillment' => [
        'existing' => "Kompetenz wurde dem Mitglied bereits zugewiesen.",
        'inexistant' => "Entsprechende Kompetenz ist dem Mitglied nicht zugewiesen.",
        'non_assigned' => "Funktion kann vom Mitglied mangels Kompetenzen nicht erfüllt werden.",
    ],
    'genre' => [
        'existing' => "Genre \":name\" existiert bereits.",
        'inexistant' => "Kein entsprechendes Genre gefunden.",
    ],
    'gift' => [
        'existing' => "Preis \":name\" existiert bereits.",
        'inexistant' => "Keinen entsprechenden Preis gefunden.",
    ],
    'guarantee' => [
        'existing' => "Die Künstler dieses Events sind bereits vertreten durch einen anderen Künstler-Vertreter.",
        'inexistant' => "Kein Künstler-Vertreter verknüpft mit Event.",
    ],
    'illustration' => [
        'existing' => "Bild illustriert bereits einen anderen Künstler.",
        'inexistant' => "Bild illustriert keinen Künstler.",
        'inadequate' => "Bild illustriert keinen Künstler des Events.",
    ],
    'image' => [
        'inexistant' => "Kein entsprechendes Bild gefunden.",
        'existing' => "Bild \":name\" existiert bereits.",
    ],
    'instrument' => [
        'existing' => "Instrument \":name\" existiert bereits.",
        'inexistant' => "Kein entsprechendes Instrument gefunden.",
    ],
    'language' => [
        'inexistant' => "Keine entsprechende Sprache gefunden.",
        'missing' => "Lokal-Variable \"locale\" fehlt.",
    ],
    'lineup' => [
        'existing' => "Musiker spielt dieses Instrument bereits für diesen Künstler.",
        'inexistant' => "Keinen entsprechenden Lineup-Eintrag gefunden.",
        'last_lineup' => "Letzter Lineup-Eintrag für diesen Musiker kann nicht gelöscht werden. Löschen Sie stattdessen den Musiker.",
    ],
    'link' => [
        'inexistant' => "Keinen entsprechenden Link gefunden.",
    ],
    'member' => [
        'inexistant' => "Kein entsprechendes Mitglied gefunden.",
        'existing' => "Member \":name\" existiert bereits.",
    ],
    'musician' => [
        'existing' => "Musiker \":name\" existiert bereits.",
        'inexistant' => "Keinen entsprechenden Musiker gefunden.",
        'nolineup' => "Kein gültiger Lineup-Eintrag für Musiker.",
        'no_instrument_artist' => "Lineup-Eintrag mit diesem Instrument und diesem Künstler existiert nicht: :key.",
        'no_instrument' => "Lineup-Eintrag mit diesem Instrument existiert nicht: :key.",
        'no_artist' => "Lineup-Eintrag mit diesem Künstler existiert nicht: :key.",
    ],
    'need' => [
        'existing' => "Entsprechender Bedarf existiert bereits.",
        'inexistant' => "Keinen entsprechenden Bedarf gefunden.",
        'non_needed' => "Entsprechende Funktion wird für diesen Event nicht benötigt.",
        'not_unique' => "Doppel in Bedarf!",
    ],
    'offer' => [
        'existing' => "Entsprechendes Verlosungs-Angebot existiert bereits.",
        'inexistant' => "Kein entsprechendes Verlosungs-Angebot gefunden.",
        'not_unique' => "Doppel in Verlosung-Angebot!",
    ],
    'performer' => [
        'existing' => "Künstler spielt bereits an entsprechender Position für diesen Event.",
        'inexistant' => "Keine entsprechende Performence des Künstlers gefunden.",
        'order_not_available' => "Diese Position ist bereits von einem anderen Künstler besetzt.",
        'not_unique' => "Doppel in Performence der Künstler!",
    ],
    'printing' => [
        'existing' => "Druckprodukttyp ist bereits mit Event verlinkt.",
        'inexistant' => "Keinen ensprechenden Druckauftrag gefunden.",
    ],
    'printing_type' => [
        'existing' => "Druckprodukttyp \":name\" existiert bereits.",
        'inexistant' => "Keinen ensprechenden Druckprodukttyp gefunden.",
    ],
    'representer' => [
        'inexistant' => "Keinen entsprechenden Künstler-Vertreter gefunden.",
        'existing' => "Künstler-Vertreter \":name\" existiert bereits.",
    ],
    'routes' => [
        'missing' => "Uups! Dies URL existiert nicht.",
    ],
    'sharing' => [
        'inexistant' => "Keine entsprechende Mitteilung gefunden.",
    ],
    'skill' => [
        'existing' => "Funktion \":name\" existiert bereits.",
        'inexistant' => "Keine ensprechende Funktion gefunden.",
    ],
    'staff' => [
        'existing' => "Dieses Mitglied erfüllt bereits diese Funktion für diesen Event.",
        'inexistant' => "Keinen entsprechenden Staff gefunden.",
        'not_unique' => "Ein Mitglied kann nicht mehr als eine Funktion pro Event haben.",
    ],
    'symbolization' => [
        'existing' => "Event hat bereits ein zugewiesenes Bild.",
        'inexistant' => "Event hat kein zugewiesenes Bild.",
        'attach_image_not_performer' => "Das zugewiesene Bild illustriert einen Künstler, der nicht an diesem Event auftritt. Es kann nicht deshalb nicht als Bild für den Event verwendet werden.",
    ],
    'ticket' => [
        'existing' => "Ticket mit entsprechender Ticketkategorie existiert bereits.",
        'inexistant' => "Kein entsprechendes Ticket gefunden.",
        'last_ticket' => "Das Ticket ist das letzte dem Event zugewiesene und kann deshalb nicht gelöscht werden.",
    ],
    'ticket_category' => [
        'existing' => "Ticketkategorie \":name\" existiert bereits.",
        'inexistant' => "Keine entsprechende Ticketkategorie gefunden.",
        'not_unique' => "Doppel in Ticketkategorie.",
    ],
   
];
