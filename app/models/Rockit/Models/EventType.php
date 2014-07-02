<?php

namespace Rockit\Models;

use Illuminate\Database\Eloquent\SoftDeletingTrait,
    Rockit\Traits\Models\ModelBCRDTrait;

/**
 * Contains the attributes and methods of an EventType model in the database.<br>
 * An EventType categorizes an Event. An Event must be categorized by one, and only one EventType.<br>
 * Based on the Laravel's Eloquent.<br>
 * 
 * @author generated with Laravel Schema Designer <laravelsd.com>
 * @author Christopher De Guzman <christopher.deguzman@heig-vd.ch>
 */
class EventType extends \Eloquent {

    use SoftDeletingTrait,
        ModelBCRDTrait;

    protected $table = 'event_types';
    protected $dates = ['deleted_at'];
    protected $hidden = ['deleted_at'];

    /**
     * Indicates whether this model uses laravel's timestamps.
     * @var boolean 
     */
    public $timestamps = false;

    /**
     * Indicates which field value should be used in the return messages.
     * @var string 
     */
    public static $response_field = 'name_de';

    /**
     * Validations rules for creating a new EventType.
     * @var array 
     */
    public static $create_rules = array(
        'name_de' => 'required',
    );

    /**
     * Get the Events to which an EventType is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function events() {
        return $this->hasMany('Rockit\Models\Event');
    }

}
