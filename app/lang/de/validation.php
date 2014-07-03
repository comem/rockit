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

	"accepted"             => "Attribut :attribute muss akzeptiert werden.",
	"active_url"           => "Attribut :attribute ist keine gültige URL.",
	"after"                => "Attribut :attribute muss ein Datum nach :date sein.",
	"alpha"                => "Attribut :attribute darf nur Buchstaben enthalten.",
	"alpha_dash"           => "Attribut :attribute darf nur Buchstaben, '-' und '_' enthalten.",
	"alpha_num"            => "Attribut :attribute darf nur Buchstaben und Zahlen enthalten.",
	"array"                => "Attribut :attribute muss eine Tabelle (Array) sein.",
	"before"               => "Attribut :attribute muss ein Datum vor :date sein.",
	"between"              => array(
		"numeric" => "Attribut :attribute muss enthalten sein zwischen :min und :max.",
		"file"    => "Attribut :attribute muss eine Dateigrösse zwischen :min und :max Kb (kilobytes) haben.",
		"string"  => "Attribut :attribute muss zwischen :min und :max Zeichen haben.",
		"array"   => "Attribut :attribute muss zwischen :min und :max Elemente haben.",
	),
	"confirmed"            => "Verifizierung des Attributs :attribute hat nicht funktioniert.",
	"date"                 => "Attribut :attribute ist kein gültiges Datum.",
	"date_format"          => "Attribut :attribute entspricht nicht dem Format :format.",
	"different"            => "Die Attribute :attribute und :other müssen unterschliedlich sein.",
	"digits"               => "Attribut :attribute muss :digits Zeichen haben.",
	"digits_between"       => "Attribut :attribute muss zwischen :min und :max Zeichen haben.",
	"email"                => "Attribut :attribute muss eine gültige E-Mail-Adresse sein.",
	"exists"               => "Gewähltes Attribut :attribute ist nicht gültig.",
	"image"                => "Attribut :attribute muss ein Bild sein.",
	"in"                   => "Gewähltes Attribut :attribute ist nicht gültig.",
	"integer"              => "Attribut :attribute muss des Typs Integer (int) sein.",
	"ip"                   => "Attribut :attribute muss eine gültige IP-Adresse sein.",
	"max"                  => array(
		"numeric" => "Attribut :attribute darf nicht höher sein als :max.",
		"file"    => "Attribut :attribute darf die Dateigrösse von :max Kb (kilobytes) nicht überschreiten.",
		"string"  => "Attribut :attribute darf nicht mehr als :max Zeichen enthalten.",
		"array"   => "Attribut :attribute darf nicht mehr als :max Elemente enthalten.",
	),
	"mimes"                => "Attribut :attribute muss eine Datei des Typs :values sein.",
	"min"                  => array(
		"numeric" => "Attribut :attribute muss höher als :min sein.",
		"file"    => "Attribut :attribute muss eine minimale Dateigrösse von :min Kb (kilobytes) aufweisen.",
		"string"  => "Attribut :attribute muss mindestens :min Zeichen enthalten.",
		"array"   => "Attribut :attribute muss mindestens :min Elemente enthalten.",
	),
	"names"                => "Attribut :attribute darf nur Buchstaben, Apostrophe, Divis und Underline enthalten.",
	"not_in"               => "Gewähltes Attribut :attribute ist nicht gültig.",
	"numeric"              => "Attribut :attribute muss eine Nummer sein.",
	"phone"                => "Format des Attributs :attribute nicht gültig.",
	"regex"                => "Format des Attributs :attribute nicht gültig.",
	"required"             => "Attribut :attribute ist obligatorisch.",
	"required_if"          => "Attribut :attribute ist obligatorisch, weil :other den Wert von :value hat.",
	"required_with"        => "Attribut :attribute ist obligatorisch, wenn :values vorhanden ist.",
	"required_with_all"    => "Attribut :attribute ist obligatorisch, wenn :values vorhanden ist.",
	"required_without"     => "Attribut :attribute ist obligatorisch, wenn :values nicht vorhanden ist.",
	"required_without_all" => "Attribut :attribute ist obligatorisch, wenn keines der Attribute :values vorhanden ist.",
	"same"                 => "Attribute :attribute und :other müssen identisch sein.",
	"size"                 => array(
		"numeric" => "Attribut :attribute muss so gross sein: :size.",
		"file"    => "Attribut :attribute muss eine Dateigrösse von :size Kb (kilobytes) haben.",
		"string"  => "Attribut :attribute muss :size Zeichen enthalten.",
		"array"   => "Attribut :attribute muss :size Elemente enthalten.",
	),
	"unique"               => "Attribut :attribute wurde bereits verwendet.",
	"url"                  => "Format des Attributs :attribute nicht gültig.",

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
