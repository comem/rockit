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
        'existing' => "Il y a déjà une attribution de même type enregistrée.",
        'inexistant' => "Il n'existe aucune attribution correspondante.",
    ],
    'auth' => "Vous devez être authentifié pour effectuer cette action",
    'description' => [
        'existing' => "Cet artiste est déjà lié à ce genre.",
        'inexistant' => "Il n'existe aucune description correspondante.",
        'last_genre' => "Ce genre est le dernier pour cet artiste, vous ne pouvez pas le supprimer.",
    ],
    'empty_data' => "Il n'y a rien à mettre à jour.",
    'equipment' => [
        'existing' => "Il y a déjà un équipement \":name\" enregistré.",
        'inexistant' => "Il n'existe aucun équipement correspondant.",
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
        'existing' => "Il y a déjà un type d'événement \":name\" enregistré.",
        'inexistant' => "Il n'existe aucun type d'événement correspondant.",
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
        'existing' => "Il y a déjà un genre \":name\" enregistré.",
        'inexistant' => "Il n'existe aucun genre correspondant.",
    ],
    'gift' => [
        'existing' => "Il y a déjà un lot \":name\" enregistré.",
        'inexistant' => "Il n'existe aucun lot correspondant.",
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
        'inexistant' => "Il n'existe aucune image correspondants.",
        'existing' => "Il y a déjà une image enregistrée pour \":name\".",
    ],
    'instrument' => [
        'existing' => "Il y a déjà un instrument \":name\" enregistré.",
        'inexistant' => "Il n'existe aucun instrument correspondant.",
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
        'inexistant' => "Il n'existe aucun membre correspondant.",
        'existing' => "Il y a déjà un membre \":name\" enregistré.",
    ],
    'musician' => [
        'existing' => "Il y a déjà un musician \":name\" enregistré.",
        'inexistant' => "Il n'existe aucun musician correspondant.",
        'nolineup' => "Aucune formation valide pour ce musicien.",
        'no_instrument_artist' => "L'instrument et l'artiste n'existent pas pour la formation :key.",
        'no_instrument' => "L'instrument n'existe pas pour la formation :key.",
        'no_artist' => "L'artiste n'existe pas pour la formation :key.",
    ],
    'need' => [
        'existing' => "Il y a déjà un besoin de même type enregistré.",
        'inexistant' => "Il n'existe aucun besoin correspondant.",
        'non_needed' => "Cette compétence n'est pas demandée lors de cet événement.",
    ],
    'offer' => [
        'existing' => "Il y a déjà une offre de même type enregistrée.",
        'inexistant' => "Il n'existe aucune offre correspondante.",
    ],
    'performer' => [
        'existing' => "Ce groupe joue déjà dans cet événement à cette position.",
        'inexistant' => "Il n'existe aucun performeur correspondant.",
        'order_not_available' => "Cette position de passage est déjà occupée par un autre artiste.",
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
        'inexistant' => "Il n'existe aucun représenant correspondant.",
        'existing' => "Il existe déjà un représentant \":name\" enregistré.",
    ],
    'routes' => [
        'missing' => "Oups! Cette url n'existe pas",
    ],
    'sharing' => [
        'inexistant' => "Il n'existe aucun sharing correspondant.",
        'no_platform' => "Aucune plateforme a été trouvé.",
    ],
    'skill' => [
        'existing' => "Il y a déjà une compétence \":name\" enregistrée.",
        'inexistant' => "Il n'existe aucune compétence correspondante.",
    ],
    'staff' => [
        'existing' => "Ce membre effectue déjà un autre rôle pour cet événement.",
        'inexistant' => "Il n'existe aucun staff correspondant.",
    ],
    'symbolization' => [
        'existing' => "Cet événement à déjà une image de couverture.",
        'inexistant' => "Cet événement n'a pas d'image de couverture.",
        'attach_image_not_performer' => "Cette image n'illustre aucun artiste jouant dans cet événement, il n'est pas possible de l'utiliser comme image de couverture",
    ],
    'ticket' => [
        'existing' => "Il y a déjà un ticket d'entrée de même type enregistré.",
        'inexistant' => "Il n'existe aucun ticket d'entrée correspondant.",
        'last_ticket' => "Ce ticket d'entrée est le dernier pour cet événement, vous ne pouvez pas le supprimer.",
    ],
    'ticket_category' => [
        'existing' => "Il y a déjà une catégorie de tickets \":name\" enregistrée.",
        'inexistant' => "Il n'existe aucune catégorie de tickets correspondante.",
    ],
    'wordexport' => [
        'noinput' => "Les dates de début et de fin de la période à exporter sont obligatoires.",
    ],
    'xmlexport' => [
        'noinput' => "Les dates de début et de fin de la période à exporter sont obligatoires.",
    ],
];
