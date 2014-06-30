<?php

namespace Rockit;

use Rockit\Models\CompletePivotModelTrait;

/**
 * Contains the attributes and methods of an Attribution model.<br>
 * An Attribution is the relationship between an Event and an Equipment that is reserved for that Event.<br>
 * Based on the Laravel's Eloquent.<br>
 * 
 * @author ??
 */
class Attribution extends \Eloquent {

    use CompletePivotModelTrait;

    protected $table = 'attributions';
    protected $hidden = ['equipment_id', 'event_id'];

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
     * Indicates which field value should be used in the return messages.
     * @var string 
     */
    public static $create_rules = [
        'cost' => 'integer|min:0',
        'quantity' => 'integer|min:1',
        'event_id' => 'integer|required|min:1|exists:events,id',
        'equipment_id' => 'integer|required|min:1|exists:equipments,id',
    ];

    /**
     * Validation rules for updating an existing Language.
     * @var array 
     */
    public static $update_rules = [
        'cost' => 'integer|min:0',
        'quantity' => 'integer|min:1',
    ];

    /**
     * Get the Equipment to which an Attribution is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function equipment() {
        return $this->belongsTo('Rockit\Equipment');
    }

    /**
     * Get the Event to which an Attribution is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function event() {
        return $this->belongsTo('Rockit\Event');
    }

}
