<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait,
	Rockit\Models\ModelBCRDTrait;

class Equipment extends \Eloquent {

	use SoftDeletingTrait,
		ModelBCRDTrait;

	protected $table = 'equipments';
	protected $dates = ['deleted_at'];

	public $timestamps = false;

	public static $create_rules = array(
		'name_de' => 'required',
	);

	public function events()
	{
		return $this->belongsToMany('Rockit\Event')->withPivot('quantity','cost');
	}

}