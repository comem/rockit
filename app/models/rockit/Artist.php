<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Artist extends \Eloquent {

	protected $table = 'artists';
	public $timestamps = true;

	use SoftDeletingTrait;

	protected $dates = ['deleted_at'];

	public function links()
	{
		return $this->hasMany('Link');
	}

	public function genres()
	{
		return $this->belongsToMany('Genre');
	}

	public function images()
	{
		return $this->hasMany('Image');
	}

	public function musicians()
	{
		return $this->belongsToMany('Musician');
	}

	public function events()
	{
		return $this->belongsToMany('Event')->withPivot('order','is_support','artist_hour_of_arrival');
	}

}