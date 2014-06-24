<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait,
	Rockit\Models\ModelBCRDTrait;

class EventType extends \Eloquent {

	use SoftDeletingTrait,
		ModelBCRDTrait;

	protected $table = 'event_types';
	protected $dates = ['deleted_at'];

	public $timestamps = false;
	public static $response_field = 'name_de';

	public static $create_rules = array(
		'name_de' => 'required',
	);

	public function events()
	{
		return $this->hasMany('Rockit\Event');
	}

}
