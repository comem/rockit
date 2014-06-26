<?php

/*
 * Fail messages
 */

return array(
    'language' => array(
        'inexistant' => "Cette langue n'existe pas",
        'missing' => "L'attribut 'locale' est manquant",
    ),
    'routes' => array(
        'missing' => "Oups! Cette url n'existe pas",
    ),
    'event' => array(
        'overlap' => "Il y a déjà un événement planifié pour cette date là !",
        'existing' => "Il y a déjà un événement ':name' enregistré !",
        'inexistant' => "Il n'y aucun équipement enregistré correspondant !",
        'at_least_one_main_performer' => "L'événement doit accueillir au moins un group principale !",
        'is_symbolized' => "L'événement doit avoir une image de couverture pour être publié !",
    ),
    'representer' => array(
        'inexistant' => "Ce représentant n'existe pas.",
    ),
    'equipment' => array(
        'existing' => "Il y a déjà un équipement ':name' enregistré !",
        'inexistant' => "Il n'y aucun équipement enregistré correspondant !",
    ),
    'genre' => array(
        'existing' => "Il y a déjà un genre ':name' enregistré !",
        'inexistant' => "Il n'y aucun genre enregistré correspondant !",
    ),
    'instrument' => array(
        'existing' => "Il y a déjà un instrument ':name' enregistré !",
        'inexistant' => "Il n'y aucun instrument enregistré correspondant !",
    ),
    'gift' => array(
        'existing' => "Il y a déjà un lot ':name' enregistré !",
        'inexistant' => "Il n'y aucun lot enregistré correspondant !",
    ),
    'event_type' => array(
        'existing' => "Il y a déjà un type d'événement ':name' enregistré !",
        'inexistant' => "Il n'y aucun type d'événement enregistré correspondant !",
    ),
    'printing_type' => array(
        'existing' => "Il y a déjà un type d'imprimé ':name' enregistré !",
        'inexistant' => "Il n'y aucun type d'imprimé enregistré correspondant !",
    ),
    'event_type' => array(
        'existing' => "Il y a déjà une catégorie de tickets ':name' enregistré !",
        'inexistant' => "Il n'y aucun catégorie de tickets enregistré correspondant !",
    ),
    'skill' => array(
        'existing' => "Il y a déjà une compétence ':name' enregistrée !",
        'inexistant' => "Il n'y aucune compétence enregistrée correspondante !",
    ),
    'instrument' => array(
        'existing' => "Cet instrument existe déjà.",
    ),
    'attribution' => array(
        'existing' => "Il y a déjà une attribution de même type enregistrée !",
        'inexistant' => "Il n'y aucune attribution enregistrée correspondante !",
    ),
    'acl' => "Vous n'avez pas le droit d'effectuer cette action",
    'auth' => "Vous devez être authentifié pour effectuer cette action",
    'offer' => array(
        'existing' => "Il y a déjà une offre de même type enregistrée !",
        'inexistant' => "Il n'y aucune offre enregistrée correspondante !",
    ),
    'ticket' => array(
        'existing' => "Il y a déjà un ticket d'entrée de même type enregistré !",
        'inexistant' => "Il n'y aucun ticket d'entrée enregistré correspondant !",
        'last_ticket' => "Ce ticket d'entrée est le dernier, vous ne pouvez pas le supprimé !",
    ),
    'need' => array(
        'existing' => "Il y a déjà un besoin de même type enregistré !",
        'inexistant' => "Il n'y aucun besoin enregistré correspondant !",
        'non_needed' => "Cette compétence n'est pas requise pour cet événement !",
    ),
    'fulfillment' => array(
        'existing' => "Il y a déjà une compétence assignée à ce membre !",
        'inexistant' => "Il n'y aucune compétence assignée correspondante !",
        'non_assigned' => "Cette compétence ne peut pas être remplie par ce membre !",
    ),
    'staff' => array(
        'existing' => "Il y a déjà un role assignée à ce membre !",
        'inexistant' => "Il n'y aucun role assignée correspondant !",
    ),
    'lineup' => array(
        'existing' => "Ce musician joue déjà de cet instrument !",
        'inexistant' => "La formation n'existe pas !",
        'last_lineup' => "Cette formation est la dernière, vous ne pouvez pas la supprimée !",
    ),
    'description' => array(
        'existing' => "Cet artist est déjà lié à ce genre !",
        'inexistant' => "Cette description n'existe pas !",
        'last_genre' => "Ce genre est le dernier, vous ne pouvez pas le supprimé !",
    ),
    'printing' => array(
        'existing' => "Ce type d'imprimé est déjà lié à cet événement !",
        'inexistant' => "Il n'y aucun imprimé correspondant !",
    ),
    'performer' => array(
        'existing' => "Ce groupe joue déjà dans cet événement à cette position !",
        'inexistant' => "Il n'y aucune liaison correspondant !",
    ),
    'musician' => array(
        'existing' => "Il y a déjà un musician ':name' enregistré !",
        'inexistant' => "Il n'y aucun musician enregistré correspondant !",
    ),
    'illustration' => array(
        'existing' => "Il y a déjà une relation pour cette image !",
        'inexistant' => "Il n'y aucune relation pour cette image !",
    ),
    'file' => array(
        'invalid' => "Le fichier n'est pas un fichier valide.",
        'inexistant' => "Le fichier auquel vous tentez d'accéder n'existe pas.",
        'unsupported' => "Le type du fichier sélectionné n'est pas supporté.",
    ),
);
