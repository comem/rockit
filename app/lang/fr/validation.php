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
		"file"    => "L'attribut :attribute doit avoir un poids compris entre :min et :max Ko.",
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
	"image"                => "The :attribute must be an image.",
	"in"                   => "The selected :attribute is invalid.",
	"integer"              => "The :attribute must be an integer.",
	"ip"                   => "The :attribute must be a valid IP address.",
	"max"                  => array(
		"numeric" => "L'attribut :attribute ne peut pas être plus grand que :max caracters.",
		"file"    => "The :attribute may not be greater than :max kilobytes.",
		"string"  => "L'attribut :attribute ne peut pas être plus grand que :max caracters.",
		"array"   => "The :attribute may not have more than :max items.",
	),
	"mimes"                => "The :attribute must be a file of type: :values.",
	"min"                  => array(
		"numeric" => "The :attribute must be at least :min.",
		"file"    => "The :attribute must be at least :min kilobytes.",
		"string"  => "The :attribute must be at least :min characters.",
		"array"   => "The :attribute must have at least :min items.",
	),
	"not_in"               => "The selected :attribute is invalid.",
	"numeric"              => "The :attribute must be a number.",
	"regex"                => "The :attribute format is invalid.",
	"required"             => "The :attribute field is required.",
	"required_if"          => "The :attribute field is required when :other is :value.",
	"required_with"        => "The :attribute field is required when :values is present.",
	"required_with_all"    => "The :attribute field is required when :values is present.",
	"required_without"     => "The :attribute field is required when :values is not present.",
	"required_without_all" => "The :attribute field is required when none of :values are present.",
	"same"                 => "The :attribute and :other must match.",
	"size"                 => array(
		"numeric" => "The :attribute must be :size.",
		"file"    => "The :attribute must be :size kilobytes.",
		"string"  => "The :attribute must be :size characters.",
		"array"   => "The :attribute must contain :size items.",
	),
	"unique"               => "The :attribute has already been taken.",
	"url"                  => "The :attribute format is invalid.",

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
