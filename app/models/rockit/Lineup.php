<?php

namespace Rockit;

class Lineup extends \Eloquent {

	protected $table = 'lineups';
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