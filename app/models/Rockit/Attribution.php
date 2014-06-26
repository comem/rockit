<?php

namespace Rockit;

use Rockit\Models\CompletePivotModelTrait;

class Attribution extends \Eloquent {

	use CompletePivotModelTrait;

	protected $table = 'attributions';
	
	public $timestamps = false;
	public static $create_rules = [
		'cost' 			=> 'integer|min:0',
		'quantity' 		=> 'integer|min:1',
		'event_id' 		=> 'integer|required|min:1|exists:events,id',
		'equipment_id' 	=> 'integer|required|min:1|exists:equipments,id',
	];
	public static $update_rules = [
		'cost' 			=> 'integer|min:0',
		'quantity' 		=> 'integer|min:1',
	];
	public static $response_field = 'id';

	public function equipment()
	{
		return $this->belongsTo('Rockit\Equipment');
	}

	public function event()
	{
		return $this->belongsTo('Rockit\Event');
	}

}
