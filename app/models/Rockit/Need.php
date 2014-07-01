<?php

namespace Rockit;

use Rockit\Models\CompletePivotModelTrait;

class Need extends \Eloquent {

	use CompletePivotModelTrait;

	protected $table = 'needs';
	protected $hidden = ['skill_id', 'event_id'];

	public $timestamps = false;
	public static $create_rules = [
		'nb_people' 	=> 'integer|required|min:1',
		'event_id' 		=> 'integer|required|min:1|exists:events,id',
		'skill_id' 		=> 'integer|required|min:1|exists:skills,id',
	];
	public static $create_event_rules = [
		'nb_people' 	=> 'integer|required|min:1',
		'skill_id' 		=> 'integer|required|min:1|exists:skills,id',
	];
	public static $update_rules = [
		'nb_people' 	=> 'integer|min:1',
	];
	public static $response_field = 'id';

	public function skill()
	{
		return $this->belongsTo('Rockit\Skill');
	}

	public function event()
	{
		return $this->belongsTo('Rockit\Event');
	}

}
