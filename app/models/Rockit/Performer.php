<?php

namespace Rockit;

use Rockit\Models\CompletePivotModelTrait;

class Performer extends \Eloquent {

	use CompletePivotModelTrait;

	protected $table = 'performers';

	public $timestamps = false;
	public static $create_rules = [
		'order' 				=> 'integer|required|min:0',
		'is_support'			=> 'boolean',
		'artist_hour_of_arival' => 'date',
		'event_id' 				=> 'integer|required|min:1|exists:events,id',
		'artist_id' 			=> 'integer|required|min:1|exists:artists,id',
	];
	public static $update_rules = [
		'order' 				=> 'integer|min:0',
		'is_support'			=> 'boolean',
		'artist_hour_of_arival' => 'date',
	];
	public static $response_field = 'id';



    public static function existByIds($data) {
        return self::where('artist_id', '=', $data['artist_id'])
        			->where('event_id', '=', $data['event_id'])
        			->where('order', '=', $data['order'])
        			->first();
    }

}
