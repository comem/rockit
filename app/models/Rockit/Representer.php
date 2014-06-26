<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Representer extends \Eloquent {

	public $timestamps = true;

	use SoftDeletingTrait;

	protected $table = 'representers';
	protected $dates = ['deleted_at'];
	protected $hidden = ['deleted_at'];

	public function events()
	{
		return $this->hasMany('Rockit\Event');
	}

}