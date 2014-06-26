<?php

namespace Rockit;

use Rockit\Models\CompletePivotModelTrait;

class Offer extends \Eloquent {

	use CompletePivotModelTrait;

	protected $table = 'offers';

	public $timestamps = false;
	public static $create_rules = [
		'cost' 			=> 'integer|min:0',
		'quantity' 		=> 'integer|required|min:1',
		'comment_de' 	=> 'min:1',
		'event_id' 		=> 'integer|required|min:1|exists:events,id',
		'gift_id' 		=> 'integer|required|min:1|exists:gifts,id',
	];
	public static $update_rules = [
		'cost' 			=> 'integer|min:0',
		'quantity' 		=> 'integer|min:1',
		'comment_de' 	=> 'min:1',
	];
	public static $response_field = 'id';

	public function gift()
	{
		return $this->belongsTo('Rockit\Gift');
	}

	public function event()
	{
		return $this->belongsTo('Rockit\Event');
	}

}