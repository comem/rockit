<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"             => "L'attribut :attribute doit être accepté.",
	"active_url"           => "L'attribut :attribute n'est pas une URL valide.",
	"after"                => "L'attribut :attribute doit être une date postérieure à :date.",
	"alpha"                => "L'attribut :attribute ne peut contenir que des lettres.",
	"alpha_dash"           => "L'attribut :attribute ne peut contenir que des lettres, des nombres et des tirets ('-' ou '_').",
	"alpha_num"            => "L'attribut :attribute ne peut contenir que des lettres et des nombres.",
	"array"                => "L'attribut :attribute doit être un tableau (array).",
	"before"               => "L'attribut :attribute doit être une date antérieure à :date.",
	"between"              => array(
		"numeric" => "L'attribut :attribute doit être compris entre :min et :max.",
		"file"    => "L'attribut :attribute doit avoir un poids compris entre :min et :max Ko (kilobytes).",
		"string"  => "L'attribut :attribute doit avoir entre :min et :max caractères.",
		"array"   => "L'attribut :attribute doit avoir entre :min et :max éléments.",
	),
	"confirmed"            => "La validation de l'attribut :attribute ne correspond pas.",
	"date"                 => "L'attribut :attribute n'est pas une date valide.",
	"date_format"          => "L'attribut :attribute ne correspond pas au :format.",
	"different"            => "Les attributs :attribute et :other doivent être différents.",
	"digits"               => "L'attribut :attribute doit avoir :digits chiffre(s).",
	"digits_between"       => "L'attribut :attribute doit avoir entre :min et :max chiffre(s).",
	"email"                => "L'attribut :attribute doit être une adresse e-mail valide.",
	"exists"               => "L'attribut :attribute sélectionné n'est pas valide.",
	"image"                => "L'attribut :attribute doit être une image.",
	"in"                   => "L'attribut :attribute sélectionné n'est pas valide.",
	"integer"              => "L'attribut :attribute doit être de type integer (int).",
	"ip"                   => "L'attribut :attribute doit être une adresse IP valide.",
	"max"                  => array(
		"numeric" => "L'attribut :attribute ne peut pas être supérieur à :max.",
		"file"    => "L'attribut :attribute ne peut pas avoir un poids supérieur à :max Ko (kilobytes).",
		"string"  => "L'attribut :attribute ne peut pas avoir plus que :max caracters.",
		"array"   => "L'attribut :attribute ne peut pas avoir plus de :max éléments.",
	),
	"mimes"                => "L'attribut :attribute doit être un fichier de type : :values.",
	"min"                  => array(
		"numeric" => "L'attribut :attribute doit être supérieur à :min.",
		"file"    => "L'attribut :attribute doit avoir un poids minimum de :min kilobytes (Ko).",
		"string"  => "L'attribut :attribute doit avoir au minimum :min caractères.",
		"array"   => "L'attribut :attribute doit avoir au minimum :min éléments.",
	),
	"names"                => "L'attribut :attribute ne peut contenir que des lettres, des apostrophes ou des tirets bas.",
	"not_in"               => "L'attribut :attribute sélectionné n'est pas valide.",
	"numeric"              => "L'attribut :attribute doit être un nombre.",
	"phone"                => "Le format de l'attribut :attribute n'est pas valide.",
	"regex"                => "Le format de l'attribut :attribute n'est pas valide.",
	"required"             => "L'attribut :attribute est obligatoire.",
	"required_if"          => "L'attribut :attribute est obligatoire lorsque :other a une valeur de :value.",
	"required_with"        => "L'attribut :attribute est obligatoire lorsque :values est présent.",
	"required_with_all"    => "L'attribut :attribute est obligatoire lorsque :values est présent.",
	"required_without"     => "L'attribut :attribute est obligatoire lorsque :values est absent.",
	"required_without_all" => "L'attribut :attribute est obligatoire lorsqu'aucun des attributs :values n'est présent.",
	"same"                 => "Les attributs :attribute et :other doivent être identiques.",
	"size"                 => array(
		"numeric" => "L'attribut :attribute doit être égal à :size.",
		"file"    => "L'attribut :attribute doit avoir un poids égal à :size kilobytes (Ko).",
		"string"  => "L'attribut :attribute doit avoir :size caractères.",
		"array"   => "L'attribut :attribute doit contenir :size éléments.",
	),
	"unique"               => "L'attribut :attribute est déjà utilisé.",
	"url"                  => "Le format de l'attribut :attribute n'est pas valide.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => array(
		'attribute-name' => array(
			'rule-name' => 'custom-message',
		),
	),

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(),

);
