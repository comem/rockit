<?php

namespace Rockit;

class Staff extends \Eloquent {

	protected $table = 'staffs';
	public $timestamps = false;

	public function skill()
	{
		return $this->belongsTo('Skill');
	}

}