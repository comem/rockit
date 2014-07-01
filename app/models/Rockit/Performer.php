<?php

namespace Rockit;

use Rockit\Models\CompletePivotModelTrait;

/**
 * Contains the attributes and methods of a Performer model in the database.<br>
 * A Performer performs at an Event and is composed of an Artist.<br>
 * Based on the Laravel's Eloquent.<br>
 * 
 * @author generated with Laravel Schema Designer <laravelsd.com>
 * @author Joël Gugger <joel.gugger@heig-vd.ch>
 */
class Performer extends \Eloquent {

    use CompletePivotModelTrait;

    protected $table = 'performers';
    protected $hidden = ['artist_id', 'event_id'];

    /**
     * Indicates whether this model uses laravel's timestamps.
     * @var boolean 
     */
    public $timestamps = false;

    /**
     * Indicates which field value should be used in the return messages.
     * @var string 
     */
    public static $response_field = 'id';

    /**
     * Validation rules for creating a new Performer.
     * @var array 
     */
    public static $create_rules = [
        'order' => 'integer|required|min:0',
        'is_support' => 'boolean',
        'artist_hour_of_arival' => 'date',
        'event_id' => 'integer|required|min:1|exists:events,id',
        'artist_id' => 'integer|required|min:1|exists:artists,id',
    ];

    /**
     * Validation rules for updating an existing Performer.
     * @var array 
     */
    public static $update_rules = [
        'order' => 'integer|min:0',
        'is_support' => 'boolean',
        'artist_hour_of_arival' => 'date',
    ];

    /**
     * Validations rules for creating a new Event with a new Performer.
     * @var array 
     */
    public static $create_event_rules = [
        'order' => 'integer|required|min:0',
        'is_support' => 'boolean',
        'artist_hour_of_arival' => 'date',
        'artist_id' => 'integer|required|min:1|exists:artists,id',
    ];

    /**
     * Get the Artist to which a Performer is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function artist() {
        return $this->belongsTo('Rockit\Artist')->withTrashed();
    }

    /**
     * Get the Event to which a Performer is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function event() {
        return $this->belongsTo('Rockit\Event');
    }

    /**
     * Check if a Performer exists, with the provided artist id, event id and order.
     *
     * @return Null or a Performer object
     */
    public static function existByIds($data) {
        return self::where('artist_id', '=', $data['artist_id'])
        ->where('event_id', '=', $data['event_id'])
        ->where('order', '=', $data['order'])
        ->first();
    }

    /**
     * Get the next available order value for a Performer of an Event.
     * If the parameter "order" is provided and has a value, this order value will be checked if it is already in use by an Artist.<br>
     * In this case, the order value will be incremented to an integer value that is not in use.
     */
    public static function getOrderAvailable(array $data, Performer $performer = null) {
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

    /**
     * Check <b>artist_id</b>'s unicity.
     * 
     * Check that there is not two identical <b>artist_id</b> in the given array.
     * 
     * @param array $array
     * @return boolean true|false
     */
    public static function isUnique(array $array) {
        $newTab = [];
        foreach ($array as $object) {
            if (!in_array($object['artist_id'], $newTab)) {
                $newTab[] = $object['artist_id'];
            }
        }
        return count($array) === count($newTab);
    }

}
