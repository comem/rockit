<?php

namespace Rockit;

use Rockit\Models\CompletePivotModelTrait;

class Need extends \Eloquent {

	use CompletePivotModelTrait;

	protected $table = 'needs';

	public $timestamps = false;
	public static $create_rules = [
		'nb_people' 	=> 'integer|required|min:1',
		'event_id' 		=> 'integer|required|min:1|exists:events,id',
		'skill_id' 		=> 'integer|required|min:1|exists:skills,id',
	];
	public static $update_rules = [
		'nb_people' 	=> 'integer|min:1',
	];
	public static $response_field = 'id';

}
