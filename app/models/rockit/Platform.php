<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Platform extends \Eloquent {

	protected $table = 'platforms';
	public $timestamps = false;

	use SoftDeletingTrait;

	protected $dates = ['deleted_at'];

	public function events()
	{
		return $this->belongsToMany('Event')->withPivot('url');
	}

}