<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Image extends \Eloquent {

	protected $table = 'images';
	public $timestamps = true;

	use SoftDeletingTrait;

	protected $dates = ['deleted_at'];

	public function artist()
	{
		return $this->belongsTo('Artist');
	}

}