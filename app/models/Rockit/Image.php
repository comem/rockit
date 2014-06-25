<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Image extends \Eloquent {

	protected $table = 'images';
    protected $hidden = ['deleted_at', 'artist_id'];
	protected $dates = ['deleted_at'];
	
	public $timestamps = true;

	use SoftDeletingTrait;


	public function artist()
	{
		return $this->belongsTo('Rockit\Artist');
	}

}