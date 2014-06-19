<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Member extends \Eloquent {

	protected $table = 'members';
	public $timestamps = true;

	use SoftDeletingTrait;

	protected $dates = ['deleted_at'];

	public function functions()
	{
		return $this->belongsToMany('Rockit\Skill');
	}

	public function events()
	{
		return $this->belongsToMany('Rockit\Event');
	}

}