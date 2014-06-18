<?php

namespace Rockit;

class Lineup extends \Eloquent {

	protected $table = 'lineups';
	public $timestamps = false;

	public function instrument()
	{
		return $this->hasOne('Instrument');
	}

}