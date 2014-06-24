<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Skill extends \Eloquent {

	protected $table = 'skills';
	public $timestamps = false;

	use SoftDeletingTrait;

	protected $dates = ['deleted_at'];

	public function membersm()
	{
		return $this->belongsToMany('Rockit\Member');
	}

	public function events()
	{
		return $this->belongsToMany('Rockit\Event')->withPivot('nb_people');
	}

	public function staffs()
	{
		return $this->hasMany('Rockit\Staff');
	}

}