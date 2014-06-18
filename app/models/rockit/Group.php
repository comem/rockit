<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Group extends \Eloquent {

	protected $table = 'groups';
	public $timestamps = true;

	use SoftDeletingTrait;

	protected $dates = ['deleted_at'];

	public function groupParent()
	{
		return $this->hasOne('Group', 'childGroup_id');
	}

	public function resources()
	{
		return $this->hasMany('Resource');
	}

	public function users()
	{
		return $this->hasMany('User');
	}

}