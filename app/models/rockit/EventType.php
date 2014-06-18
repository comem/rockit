<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class EventType extends \Eloquent {

	protected $table = 'event_types';
	public $timestamps = false;

	use SoftDeletingTrait;

	protected $dates = ['deleted_at'];

	public function events()
	{
		return $this->hasMany('Event');
	}

}