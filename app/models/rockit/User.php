<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class User extends \Eloquent {

	protected $table = 'users';
	public $timestamps = true;

	use SoftDeletingTrait;

	protected $dates = ['deleted_at'];
	protected $hidden = array('password');

	public function group()
	{
		return $this->belongsTo('Rockit\Group');
	}

	public function language()
	{
		return $this->belongsTo('Rockit\Language');
	}

}