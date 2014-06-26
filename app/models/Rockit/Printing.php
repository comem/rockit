<?php

namespace Rockit;

use Rockit\Models\CompletePivotModelTrait;

class Printing extends \Eloquent {

	use CompletePivotModelTrait;

	protected $table = 'printings';
	protected $hidden = ['printing_type_id', 'event_id'];

	public $timestamps = false;
	public static $create_rules = [
		'nb_copies' 		=> 'integer|required|min:0',
		'nb_copies_surplus'	=> 'integer|min:0',
		'event_id' 			=> 'integer|required|min:1|exists:events,id',
		'printing_type_id' 	=> 'integer|required|min:1|exists:printing_types,id',
	];
	public static $update_rules = [
		'nb_copies' 		=> 'integer|min:0',
		'nb_copies_surplus'	=> 'integer|min:0',
	];
	public static $response_field = 'id';

	public function printingType()
	{
		return $this->belongsTo('Rockit\PrintingType');
	}

	public function event()
	{
		return $this->belongsTo('Rockit\Event');
	}


}