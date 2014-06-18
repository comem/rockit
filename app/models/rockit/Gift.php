<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Gift extends \Eloquent {

	protected $table = 'gifts';
	public $timestamps = false;

	use SoftDeletingTrait;

	protected $dates = ['deleted_at'];

	public function events()
	{
		return $this->belongsToMany('Event')->withPivot('quantity','cost','comment_de');
	}

}