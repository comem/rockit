<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class PrintingType extends \Eloquent {

	protected $table = 'printing_types';
	public $timestamps = false;

	use SoftDeletingTrait;

	protected $dates = ['deleted_at'];

	public function events()
	{
		return $this->belongsToMany('Event')->withPivot('source','nb_copies','nb_copies_surplus');
	}

}