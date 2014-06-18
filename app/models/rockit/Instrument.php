<?php

namespace Rockit;

class Instrument extends \Eloquent {

	protected $table = 'instruments';
	public $timestamps = false;

	public function lineups()
	{
		return $this->belongsToMany('Lineup');
	}

}