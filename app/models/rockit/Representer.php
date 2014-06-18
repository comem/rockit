<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Representer extends \Eloquent {

	protected $table = 'representers';
	public $timestamps = true;

	use SoftDeletingTrait;

	protected $dates = ['deleted_at'];

	public function events()
	{
		return $this->hasMany('Event');
	}

}