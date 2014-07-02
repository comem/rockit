<?php

/*
 * Fail messages
 */

return [
    'acl' => "Vous n'avez pas le droit d'effectuer cette action",
    'artist' => [
        'inexistant' => "Il n'existe aucun artiste correspondant.",
        'nogenre' => "Aucun genre valide pour cet artiste.",
        'genre' => "Le genre :key n'existe pas.",
        'image' => "L'image :key n'existe pas ou n'est pas disponible.",
    ],
    'attribution' => [
        'existing' => "An attribution of the same kind is already registered.",
        'inexistant' => "No corresponding attribution is registered.",
        'not_unique' => "doublons !",
    ],
    'auth' => "You must be logged in to complete this action",
    'description' => [
        'existing' => "This artist is already linked to this genre.",
        'inexistant' => "No corresponding link between the artist and the genre is registered.",
        'last_genre' => "Ce genre est le dernier pour cet artiste, vous ne pouvez pas le supprimer.",
    ],
    'empty_data' => "Il n'y a rien à mettre à jour.",
    'equipment' => [
        'existing' => "An equipment \":name\" already exists.",
        'inexistant' => "No corresponding equipment exists.",
    ],
    'event' => [
        'overlap' => "Cet événement chevauche un événement déjà existant.",
        'existing' => "Il y a déjà un événement \":name\" enregistré.",
        'inexistant' => "Il n'existe aucun événement correspondant.",
        'at_least_one_main_performer' => "L'événement doit accueillir au moins un groupe principal.",
        'is_symbolized' => "L'événement doit avoir une image de couverture.",
        'is_not_published' => "L'événement doit être publié pour que un post peut être crée.",
    ],
    'event_type' => [
        'existing' => "An event \":name\" already exists.",
        'inexistant' => "No corresponding event exists.",
    ],
    'export' => [
        'no_input' => "Des dates de/à n'ont pas été trouvés.",
        'unchronological' => "Les dates données ne sont pas chronologiquement correcte.",
    ],
    'file' => [
        'invalid' => "Le fichier sélectionné n'est pas un fichier valide.",
        'inexistant' => "Le fichier \":file\" n'existe pas sur ce serveur.",
    ],
    'file_type' => [
        'unsupported' => "Vous ne pouvez pas sauvegarder de fichier de ce type (:type).",
    ],
    'fulfillment' => [
        'existing' => "Cette compétence est déjà assignée à ce membre.",
        'inexistant' => "Il n'existe aucune compétence correspondante assignée à ce membre.",
        'non_assigned' => "Cette compétence ne peut pas être remplie par ce membre.",
    ],
    'genre' => [
        'existing' => "A genre \":name\" already exists.",
        'inexistant' => "No corresponding genre exists.",
    ],
    'gift' => [
        'existing' => "A gift \":name\" already exists.",
        'inexistant' => "No corresponding gift exists.",
    ],
    'guarantee' => [
        'existing' => "Les artistes de cet événement sont déjà représentés par un autre représentant.",
        'inexistant' => "Il n'y a aucun représentant rattaché à cet événement.",
    ],
    'illustration' => [
        'existing' => "Cette image illustre déjà un autre artiste.",
        'inexistant' => "Cette image n'illustre aucun artiste.",
        'inadequate' => "Cette image n'illustre pas cet artiste.",
    ],
    'image' => [
        'existing' => "An image \":name\" already exists.",
        'inexistant' => "No corresponding image exists.",
    ],
    'instrument' => [
        'existing' => "An instrument \":name\" already exists.",
        'inexistant' => "No corresponding instrument exists.",
    ],
    'language' => [
        'inexistant' => "Il n'existe aucune langue correspondante.",
        'missing' => "L'attribut \"locale\" est manquant",
    ],
    'lineup' => [
        'existing' => "Ce musicien joue déjà de cet instrument pour cet artiste.",
        'inexistant' => "Il n'existe aucune formation correspondante.",
        'last_lineup' => "Cette formation est la dernière pour ce musicien, vous ne pouvez pas la supprimer.",
    ],
    'link' => [
        'inexistant' => "Il n'existe aucun lien correspondant.",
    ],
    'member' => [
        'existing' => "A member \":name\" already exists.",
        'inexistant' => "No corresponding member exists.",
    ],
    'musician' => [
        'existing' => "A musician \":name\" already exists.",
        'inexistant' => "No corresponding musician exists.",
        'nolineup' => "Aucune formation valide pour ce musicien.",
        'no_instrument_artist' => "L'instrument et l'artiste n'existent pas pour la formation :key.",
        'no_instrument' => "L'instrument n'existe pas pour la formation :key.",
        'no_artist' => "L'artiste n'existe pas pour la formation :key.",
    ],
    'need' => [
        'existing' => "A need of the same kind is already registered.",
        'inexistant' => "No corresponding need is registered.",
        'non_needed' => "Cette compétence n'est pas demandée lors de cet événement.",
        'not_unique' => "Les besoins ont des doublons !",
    ],
    'offer' => [
        'existing' => "An offer of the same kind is already registered.",
        'inexistant' => "No corresponding offer is registered.",
        'not_unique' => "doublons !",
    ],
    'performer' => [
        'existing' => "Ce groupe joue déjà dans cet événement à cette position.",
        'inexistant' => "Il n'existe aucun performeur correspondant.",
        'order_not_available' => "Cette position de passage est déjà occupée par un autre artiste.",
        'not_unique' => "Les performeurs ont des doublons !",
    ],
    'printing' => [
        'existing' => "Ce type d'imprimé est déjà lié à cet événement.",
        'inexistant' => "Il n'existe aucun imprimé correspondant.",
    ],
    'printing_type' => [
        'existing' => "Il y a déjà un type d'imprimé \":name\" enregistré.",
        'inexistant' => "Il n'existe aucun type d'imprimé correspondant.",
    ],
    'representer' => [
        'existing' => "A representer \":name\" already exists.",
        'inexistant' => "No corresponding representer exists.",
    ],
    'routes' => [
        'missing' => "Oups! Cette url n'existe pas",
    ],
    'sharing' => [
        'inexistant' => "No corresponding sharing exists.",
    ],
    'skill' => [
        'existing' => "A skill \":name\" is already registered.",
        'inexistant' => "No corresponding skill is registered.",
    ],
    'staff' => [
        'existing' => "Ce membre effectue déjà un autre rôle pour cet événement.",
        'inexistant' => "Il n'existe aucun staff correspondant.",
        'not_unique' => "Un membre ne peut pas remplire plusieurs fonctions dans la meme soirée !",
    ],
    'symbolization' => [
        'existing' => "Cet événement à déjà une image de couverture.",
        'inexistant' => "Cet événement n'a pas d'image de couverture.",
        'attach_image_not_performer' => "Cette image n'illustre aucun artiste jouant dans cet événement, il n'est pas possible de l'utiliser comme image de couverture",
    ],
    'ticket' => [
        'existing' => "A ticket of the same kind is already registered.",
        'inexistant' => "No corresponding ticket is registered.",
        'last_ticket' => "Ce ticket d'entrée est le dernier pour cet événement, vous ne pouvez pas le supprimer.",
    ],
    'ticket_category' => [
        'existing' => "A ticket category \":name\" already exists.",
        'inexistant' => "No corresponding ticket category exists.",
        'not_unique' => "...doublon...",
    ],
    'wordexport' => [
        'noinput' => "Les dates de début et de fin de la période à exporter sont obligatoires.",
    ],
    'xmlexport' => [
        'noinput' => "Les dates de début et de fin de la période à exporter sont obligatoires.",
    ],
];
