<?php

namespace Rockit;

class Sharing extends \Eloquent {
    
    use Models\ModelBCUDTrait;

	public $timestamps = true;

	protected $table = 'sharings';
	protected $hidden = ['external_id', 'external_infos', 'platform_id', 'event_id'];

	public function platform()
	{
		return $this->belongsTo('Rockit\Platform');
	}

	public function event()
	{
		return $this->belongsTo('Rockit\Event');
	}

}