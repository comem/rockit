<?php

namespace Rockit;

class Link extends \Eloquent {

	protected $table = 'links';
	public $timestamps = false;

	public function artist()
	{
		return $this->belongsTo('Artist');
	}

}