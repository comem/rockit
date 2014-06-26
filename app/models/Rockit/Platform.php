<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Platform extends \Eloquent {

	public $timestamps = false;

	protected $table = 'platforms';
	protected $hidden = ['client_id', 'client_secret', 'api_infos', 'deleted_at'];

	use SoftDeletingTrait;

	protected $dates = ['deleted_at'];

	public function events()
	{
		return $this->belongsToMany('Rockit\Event')->withPivot('url');
	}

}