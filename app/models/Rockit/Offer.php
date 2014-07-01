<?php

namespace Rockit;

use Rockit\Models\CompletePivotModelTrait;

class Offer extends \Eloquent {

	use CompletePivotModelTrait;

	protected $table = 'offers';
	protected $hidden = ['gift_id', 'event_id'];

	public $timestamps = false;
	public static $create_rules = [
		'cost' 			=> 'integer|min:0',
		'quantity' 		=> 'integer|required|min:1',
		'comment_de' 	=> 'min:1',
		'event_id' 		=> 'integer|required|min:1|exists:events,id',
		'gift_id' 		=> 'integer|required|min:1|exists:gifts,id',
	];
	public static $create_event_rules = [
		'cost' 			=> 'integer|min:0',
		'quantity' 		=> 'integer|required|min:1',
		'comment_de' 	=> 'min:1',
		'gift_id' 		=> 'integer|required|min:1|exists:gifts,id',
	];
	public static $update_rules = [
		'cost' 			=> 'integer|min:0',
		'quantity' 		=> 'integer|min:1',
		'comment_de' 	=> 'min:1',
	];
	public static $response_field = 'id';

	public function gift()
	{
		return $this->belongsTo('Rockit\Gift');
	}

	public function event()
	{
		return $this->belongsTo('Rockit\Event');
	}

    public static function isUnique( array $array ){
        $newTab = [];
        foreach( $array as $object ){
            if( !in_array($object['gift_id'], $newTab) ){
                $newTab[] = $object['gift_id'];
            }
        }
        return count( $array ) === count( $newTab );
    }

}