<?php

namespace Rockit\Models;

use \Rockit\Traits\Models\CompletePivotModelTrait;

/**
 * Contains the attributes and methods of an Offer model.<br>
 * An Offer is the relationship between a Gift and an Event that offers that Gift.<br>
 * Based on the Laravel's Eloquent.<br>
 * 
 * @author generated with Laravel Schema Designer <laravelsd.com>
 */
class Offer extends \Eloquent {

    use CompletePivotModelTrait;

    protected $table = 'offers';
    protected $appends = ['gift'];
    protected $hidden = ['gift_id', 'event_id'];

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
     * Validations rules for creating a new Offer.
     * @var array 
     */
    public static $create_rules = [
        'cost' => 'integer|min:0',
        'quantity' => 'integer|required|min:1',
        'comment_de' => 'min:1',
        'event_id' => 'integer|required|min:1|exists:events,id',
        'gift_id' => 'integer|required|min:1|exists:gifts,id',
    ];

    /**
     * Validation rules for updating an existing Offer.
     * @var array 
     */
    public static $update_rules = [
        'cost' => 'integer|min:0',
        'quantity' => 'integer|min:1',
        'comment_de' => 'min:1',
    ];

    /**
     * Validations rules for creating a new Event with a new offered Gift.
     * @var array 
     */
    public static $create_event_rules = [
        'cost' => 'integer|min:0',
        'quantity' => 'integer|required|min:1',
        'comment_de' => 'min:1',
        'gift_id' => 'integer|required|min:1|exists:gifts,id',
    ];
    
    /**
     * Indicates how the appends gift attribute should be set when creating a new Offer model.
     * In this case, this attribute will contains the result of the gift() method.
     */
    public function getGiftAttribute() {
        return $this->gift()->getResults();
    }

    /**
     * Get the Gift to which an Offer is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function gift() {
        return $this->belongsTo('Rockit\Models\Gift')->withTrashed();
    }

    /**
     * Get the Event to which an Offer is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function event() {
        return $this->belongsTo('Rockit\Models\Event');
    }

    /**
     * Check <b>gift_id</b>'s unicity.
     * 
     * Check that there is not two identical <b>gift_id</b> in the given array.
     * 
     * @param array $array
     * @return boolean true|false
     */
    public static function isUnique(array $array) {
        $newTab = [];
        foreach ($array as $object) {
            if (!in_array($object['gift_id'], $newTab)) {
                $newTab[] = $object['gift_id'];
            }
        }
        return count($array) === count($newTab);
    }

}
