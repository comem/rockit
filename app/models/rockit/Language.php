<?php

namespace Rockit;

class Language extends \Eloquent {

	protected $table = 'languages';
	public $timestamps = false;

	public function users()
	{
		return $this->hasMany('User');
	}

}