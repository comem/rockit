<?php

/*
 * Success messages
 * Syntax :
 * 'created' : "Le/La nouveau/nouvelle ... a bien été sauvegardé(e)."
 * 'updated' : "Le/La ... a bien été mis(e) à jour."
 * 'deleted' : "Le/La ... a bien été supprimé(e)."
 * 'restored' : Le/La ... a bien été restauré(e)."
 */

return [
    'artist' => [
        'created' => "Le nouvel artiste \":name\" a bien été sauvegardé.",
        'deleted' => "L'artiste \":name\" a bien été supprimé.",
        'updated' => "L'artiste \":name\" a bien été mis à jour.",
    ],
    'attribution' => [
        'created' => "La nouvelle attribution a bien été sauvegardée.",
        'updated' => "L'attribution a bien été modifiée",
        'deleted' => "L'attribution a bien été supprimée.",
    ],
    'auth' => [
        'login' => "Vous êtes maintenant authentifié.",
        'logout' => "Vous êtes maintenant déconnecté.",
    ],
    'description' => [
        'created' => "Le genre a bien été rajouté à l'artiste.",
        'deleted' => "Le genre a bien été supprimé de l'artiste.",
    ],
    'equipment' => [
        'deleted' => "L'équipement \":name\" a bien été supprimé.",
        'restored' => "L'équipement \":name\" a bien été restauré.",
        'created' => "L'équipement \":name\" a bien été sauvegardé.",
    ],
    'event' => [
        'updated' => "L'événement a bien été mis à jour.",
        'created' => "Le nouvel événement a bien été sauvegardé.",
        'deleted' => "L'événement a bien été supprimé.",
        'published' => "L'événement est maintenant publié.",
        'unpublished' => "L'événement n'est maintenant plus publié.",
    ],
    'event_type' => [
        'created' => "Le nouveau type d'événement \":name\" a bien été sauvegardé.",
        'deleted' => "Le type d'événement \":name\" a bien été supprimé.",
        'restored' => "Le type d'événement \":name\" a bien été restauré.",
    ],
    'file' => [
        'deleted' => "Le fichier \":file\" a bien été supprimé.",
        'uploaded' => "Le fichier \":file\" a bien été sauvegardé.",
    ],
    'fulfillment' => [
        'created' => "La compétence a bien été assignée.",
        'deleted' => "L'assigniation de la compétence a bien été supprimée.",
    ],
    'genre' => [
        'deleted' => "Le genre \":name\" a bien été supprimé.",
        'created' => "Le genre \":name\" a bien été sauvegardé.",
        'restored' => "Le genre \":name\" a bien été restauré.",
    ],
    'gift' => [
        'created' => "Le nouveau lot \":name\" a bien été sauvegardé.",
        'deleted' => "Le lot \":name\" a bien été supprimé.",
        'restored' => "Le lot \":name\" a bien été restauré.",
    ],
    'guarantee' => [
        'created' => "Le représentant \":name\" a bien été lié à l'événement.",
        'deleted' => "Le représentant \":name\" a bien été retiré de l'événement.",
    ],
    'illustration' => [
        'created' => "L'image a bien été ajoutée à l'artiste.",
        'deleted' => "L'image a bien été retirée de l'artiste.",
    ],
    'image' => [
        'created' => "La nouvelle image a bien été sauvegardée.",
        'deleted' => "L'image a bien été supprimée.",
        'updated' => "L'image a bien été mise à jour.",
    ],
    'instrument' => [
        'created' => "Le nouvel instrument \":name\" a bien été sauvegardé.",
        'deleted' => "L'instrument \":name\" a bien été supprimé.",
        'restored' => "L'instrument \":name\" a bien été restauré.",
    ],
    'lineup' => [
        'created' => "La formation a bien été rajoutée",
        'deleted' => "La formation a bien été supprimée",
    ],
    'link' => [
        'deleted' => "Le lien a bien été supprimé.",
        'created' => "Le lien a bien été sauvegardé.",
        'updated' => "Le lien a bien été mis à jour.",
    ],
    'member' => [
        'created' => "Le membre \":name\" a bien été sauvegardé ",
        'updated' => "Le membre \":name\" a bien été mis à jour.",
        'deleted' => "Le membre \":name\" a bien été supprimé.",
    ],
    'musician' => [
        'deleted' => "Le musicien \":name\" a bien été supprimé.",
        'created' => "Le musicien \":name\" a bien été sauvegardé.",
        'updated' => "Le musicien \":name\" a bien été mis à jour.",
    ],
    'need' => [
        'created' => "Le nouveau besoin de cet événement a bien été sauvegardé.",
        'updated' => "Le besoin a bien été modifié.",
        'deleted' => "Le besoin a bien été supprimé.",
    ],
    'offer' => [
        'created' => "La nouvelle offre a bien été sauvegardée.",
        'updated' => "L'offre a bien été modifiée",
        'deleted' => "L'offre a bien été supprimée.",
    ],
    'performer' => [
        'created' => "L'artiste a bien été rajouté à l'événement.",
        'updated' => "La performance de l'artiste a bien été modifiée.",
        'deleted' => "L'artiste a bien été supprimé de l'événement.",
    ],
    'printing' => [
        'created' => "L'imprimé a bien été rajouté à l'événement.",
        'updated' => "L'imprimé a bien été modifié.",
        'deleted' => "L'imprimé a bien été supprimé de l'événement.",
    ],
    'printing_type' => [
        'created' => "Le nouveau type d'imprimé \":name\" a bien été sauvegardé.",
        'deleted' => "Le type d'imprimé \":name\" a bien été supprimé.",
        'restored' => "Le type d'imprimé \":name\" a bien été restauré.",
    ],
    'representer' => [
        'created' => "Le nouveau représentant \":name\" a bien été sauvegardé.",
        'updated' => "Le représentant \":name\" a bien été mis à jour.",
        'deleted' => "Le représentant \":name\" a bien été supprimé.",
        'restored' => "Le représentant \":name\" a bien été restauré.",
    ],
    'skill' => [
        'deleted' => "La compétence \":name\" a bien été supprimée.",
        'restored' => "La compétence \":name\" a bien été restaurée.",
        'created' => "La nouvelle compétence \":name\" a bien été sauvegardée.",
    ],
    'staff' => [
        'created' => "Le rôle a correctement été assigné à ce membre.",
        'updated' => "Le rôle de ce membre a été mis à jour.",
        'deleted' => "Le rôle de ce membre a bien été supprimé.",
    ],
    'symbolization' => [
        'created' => "L'image a bien étée ajoutée à l'événement.",
        'deleted' => "L'image a bien été supprimée de l'événement.",
    ],
    'ticket' => [
        'created' => "Le nouveau ticket d'entrée a bien été sauvegardé.",
        'updated' => "Le ticket d'entrée a bien été modifié.",
        'deleted' => "Le ticket d'entrée a bien été supprimé.",
    ],
    'ticket_category' => [
        'created' => "La nouvelle catégorie de tickets \":name\" a bien été sauvegardée.",
        'deleted' => "La catégorie de tickets \":name\" a bien été supprimée.",
        'restored' => "La catégorie de tickets \":name\" a bien été restaurée.",
    ],
    'user' => [
        'updated' => "L'utilisateur a bien été mis à jour."
    ],
];
