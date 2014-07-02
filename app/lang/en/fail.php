<?php

/*
 * Fail messages
 */

return [
    'acl' => "You do not have the right to execute this action",
    'login' => "The user credentials are not valid.",
    'artist' => [
        'inexistant' => "No corresponding artist is registered.",
        'nogenre' => "This artist does not have a valid genre.",
        'genre' => "The genre :key does not exist.",
        'image' => "The image :key does not exist or is not available.",
    ],
    'attribution' => [
        'existing' => "An attribution of the same kind is already registered.",
        'inexistant' => "No corresponding attribution is registered.",
        'not_unique' => "The attributions provided are not unique.",
    ],
    'auth' => "You must be logged in to complete this action",
    'description' => [
        'existing' => "This artist is already linked to this genre.",
        'inexistant' => "No corresponding link between the artist and the genre is registered.",
        'last_genre' => "This genre is the artist's last genre, it cannot be deleted.",
    ],
    'empty_data' => "There is nothing to update.",
    'equipment' => [
        'existing' => "An equipment \":name\" is already registered.",
        'inexistant' => "No corresponding equipment is registered.",
    ],
    'event' => [
        'overlap' => "This event overlaps another registered event.",
        'existing' => "An event \":name\" is already registered.",
        'inexistant' => "No corresponding event is registered.",
        'at_least_one_main_performer' => "The event must have at least one main performer.",
        'is_symbolized' => "The event needs a cover image.",
        'is_not_published' => "The event's status must be 'published' in order to share the event.",
    ],
    'event_type' => [
        'existing' => "An event type \":name\" is already registered.",
        'inexistant' => "No corresponding event type is registered.",
    ],
    'export' => [
        'no_input' => "No from/to dates were provided.",
        'unchronological' => "The dates provided are not in chronological order.",
    ],
    'file' => [
        'invalid' => "The selected file is not valid.",
        'inexistant' => "The file \":file\" does not exist on the server.",
    ],
    'file_type' => [
        'unsupported' => "You cannot save a file of this format (:type).",
    ],
    'fulfillment' => [
        'existing' => "This skill has already been assigned to this member.",
        'inexistant' => "No corresponding skill-member combination is registered.",
        'non_assigned' => "The member is unable to fulfill this skill.",
    ],
    'genre' => [
        'existing' => "A genre \":name\" is already registered.",
        'inexistant' => "No corresponding genre is registered.",
    ],
    'gift' => [
        'existing' => "A gift \":name\" is already registered.",
        'inexistant' => "No corresponding gift is registered.",
    ],
    'guarantee' => [
        'existing' => "The artists of this event are already guaranteed by a representer.",
        'inexistant' => "There is no representer that guarantees this event.",
    ],
    'illustration' => [
        'existing' => "This image already illustrates another artist.",
        'inexistant' => "No corresponding image-artist combination is registered.",
        'inadequate' => "This image does not illustrate this artist.",
    ],
    'image' => [
        'existing' => "An image \":name\" is already registered.",
        'inexistant' => "No corresponding image is registered.",
    ],
    'instrument' => [
        'existing' => "An instrument \":name\" is already registered.",
        'inexistant' => "No corresponding instrument is registered.",
    ],
    'language' => [
        'inexistant' => "No corresponding language is registered.",
        'missing' => "The \"locale\" attribute is missing",
    ],
    'lineup' => [
        'existing' => "This musician already plays this instrument for this artist.",
        'inexistant' => "No corresponding artist-musician-instrument combination is registered.",
        'last_lineup' => "This lineup is the musician's last lineup, it cannot be deleted.",
    ],
    'link' => [
        'inexistant' => "No corresponding link is registered.",
    ],
    'member' => [
        'existing' => "A member \":name\" is already registered.",
        'inexistant' => "No corresponding member is registered.",
    ],
    'musician' => [
        'existing' => "A musician \":name\" is already registered.",
        'inexistant' => "No corresponding musician is registered.",
        'nolineup' => "This musician does not have a valid lineup.",
        'no_instrument_artist' => "The instrument and artist do not exist for the lineup :key.",
        'no_instrument' => "The instrument does not exist for the lineup :key.",
        'no_artist' => "The artist does not exist for the lineup :key.",
    ],
    'need' => [
        'existing' => "A need of the same kind is already registered.",
        'inexistant' => "No corresponding need is registered.",
        'non_needed' => "This skill is not needed for this event.",
        'not_unique' => "The needs provided are not unique.",
    ],
    'offer' => [
        'existing' => "An offer of the same kind is already registered.",
        'inexistant' => "No corresponding offer is registered.",
        'not_unique' => "The offers provided are not unique.",
    ],
    'performer' => [
        'existing' => "This artist already performs at this position for this event.",
        'inexistant' => "No corresponding performer is registered.",
        'order_not_available' => "This performance position is already taken by another artist.",
        'not_unique' => "The performers provided are not unique.",
    ],
    'printing' => [
        'existing' => "This printing type is already linked to this event.",
        'inexistant' => "No corresponding printing is registered.",
    ],
    'printing_type' => [
        'existing' => "A printing type \":name\" is already registered.",
        'inexistant' => "No corresponding printing type is registered.",
    ],
    'representer' => [
        'existing' => "A representer \":name\" is already registered.",
        'inexistant' => "No corresponding representer is registered.",
    ],
    'routes' => [
        'missing' => "Oops! This url does not exist",
    ],
    'sharing' => [
        'inexistant' => "No corresponding sharing is registered.",
    ],
    'skill' => [
        'existing' => "A skill \":name\" is already registered.",
        'inexistant' => "No corresponding skill is registered.",
    ],
    'staff' => [
        'existing' => "The member is already employed for a skill at this event.",
        'inexistant' => "No corresponding staff is registered.",
        'not_unique' => "One member cannot fulfill multiple skills in the same event.",
    ],
    'symbolization' => [
        'existing' => "The event already has a cover image.",
        'inexistant' => "The event does not have a cover image.",
        'attach_image_not_performer' => "This image does not illustrate an artist that performs at this event, it cannot be used as the event's cover image.",
    ],
    'ticket' => [
        'existing' => "A ticket of the same kind is already registered.",
        'inexistant' => "No corresponding ticket is registered.",
        'last_ticket' => "This ticket is the event's last ticket, it cannot be deleted.",
    ],
    'ticket_category' => [
        'existing' => "A ticket category \":name\" is already registered.",
        'inexistant' => "No corresponding ticket category is registered.",
        'not_unique' => "The ticket categories provided are not unique.",
    ],
    'wordexport' => [
        'noinput' => "The dates \"from\" and \"to\" are required to define which events will be exported.",
    ],
    'xmlexport' => [
        'noinput' => "The dates \"from\" and \"to\" are required to define which events will be exported.",
    ],
];
