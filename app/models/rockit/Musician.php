<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Musician extends \Eloquent {

	protected $table = 'musicians';
	public $timestamps = true;

	use SoftDeletingTrait;

	protected $dates = ['deleted_at'];

	public function artists()
	{
		return $this->belongsToMany('Artist');
	}

}