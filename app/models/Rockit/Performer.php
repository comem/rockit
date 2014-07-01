<?php

namespace Rockit;

use Rockit\Models\CompletePivotModelTrait;

class Performer extends \Eloquent {

    use CompletePivotModelTrait;

    protected $table = 'performers';
    protected $hidden = ['artist_id', 'event_id'];
    public $timestamps = false;
    public static $create_rules = [
        'order' => 'integer|required|min:0',
        'is_support' => 'boolean',
        'artist_hour_of_arival' => 'date',
        'event_id' => 'integer|required|min:1|exists:events,id',
        'artist_id' => 'integer|required|min:1|exists:artists,id',
    ];
    public static $create_event_rules = [
        'order' => 'integer|required|min:0',
        'is_support' => 'boolean',
        'artist_hour_of_arival' => 'date',
        'artist_id' => 'integer|required|min:1|exists:artists,id',
    ];
    public static $update_rules = [
        'order' => 'integer|min:0',
        'is_support' => 'boolean',
        'artist_hour_of_arival' => 'date',
    ];
    public static $response_field = 'id';

    /**
     * 
     * @param type $data
     * @return type
     */
    public static function existByIds($data) {
        return self::where('artist_id', '=', $data['artist_id'])
        ->where('event_id', '=', $data['event_id'])
        ->where('order', '=', $data['order'])
        ->first();
    }

    public function artist() {
        return $this->belongsTo('Rockit\Artist');
    }

    public function event() {
        return $this->belongsTo('Rockit\Event');
    }

    public static function checkOrderAvailability(array $data, Performer $performer = null) {
        if (isset($data['order'])) {
            if (!empty($performer)) {
                $exist = Performer::where('event_id', '=', $performer->event_id)
                ->where('order', '=', $data['order'])
                ->first();
            } else {
                $exist = Performer::where('event_id', '=', $data['event_id'])
                ->where('order', '=', $data['order'])
                ->first();
            }
        }
        return empty($exist);
    }

    public static function getOrderAvailable(array &$data, Performer $performer = null) {
        if (isset($data['order'])) {
            if (!empty($performer)) {
                $orders = array_flatten(Performer::select('order')->where('event_id', '=', $performer->event_id)->get()->toArray());
                while (in_array($data['order'], $orders)) {
                    ++$data['order'];
                }
            } else {
                $orders = array_flatten(Performer::select('order')->where('event_id', '=', $data['event_id'])->get()->toArray());
                while (in_array($data['order'], $orders)) {
                    ++$data['order'];
                }
            }
        }
    }

    public static function isUnique( array $array ){
        $newTab = [];
        foreach( $array as $object ){
            if( !in_array($object['artist_id'], $newTab) ){
                $newTab[] = $object['artist_id'];
            }
        }
        return count( $array ) === count( $newTab );
    }

}
