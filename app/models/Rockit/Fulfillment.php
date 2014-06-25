<?php

namespace Rockit;

use Rockit\Models\SimplePivotModelTrait;

class Fulfillment extends \Eloquent {

	use SimplePivotModelTrait;

	protected $table = 'fulfillments';

	public $timestamps = false;
	public static $create_rules = [
		'member_id' 	=> 'integer|required|min:1|exists:members,id',
		'skill_id' 		=> 'integer|required|min:1|exists:skills,id',
	];
	public static $response_field = 'id';

}