<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait,
	Rockit\Models\ModelBCRDTrait;

class Genre extends \Eloquent {
    
	use SoftDeletingTrait,
		ModelBCRDTrait;

	public static $create_rules = array(
		'name_de' => 'required',
	);

	protected $table = 'genres';
	public $timestamps = false;

	public function artists()
	{
		return $this->belongsToMany('Rockit\Artist');
	}

}