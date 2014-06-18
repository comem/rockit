<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Resource extends \Eloquent {

	protected $table = 'resources';
	public $timestamps = true;

	use SoftDeletingTrait;

	protected $dates = ['deleted_at'];

	public function groups()
	{
		return $this->belongsToMany('Group');
	}

}