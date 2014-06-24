<?php

namespace Rockit;

use Rockit\Models\SimplePivotModelTrait;

class Lineup extends \Eloquent {

	use SimplePivotModelTrait;

	protected $table = 'lineups';
	public static $create_rules = [
		'musician_id' 	=> 'integer|required|min:1|exists:musicians,id',
		'instrument_id' => 'integer|required|min:1|exists:intruments,id',
		'artist_id' 	=> 'integer|required|min:1|exists:artists,id',
	];
	public static $response_field = 'id';

	public $timestamps = false;

	public function instrument()
	{
		return $this->belongsTo('Rockit\Instrument');
	}

	public function artist()
	{
		return $this->belongsTo('Rockit\Artist');
	}

	public function musician()
	{
		return $this->belongsTo('Rockit\Musician');
	}

}