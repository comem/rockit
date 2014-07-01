<?php

namespace Rockit;

use Rockit\Models\SimplePivotModelTrait;

/**
 * Contains the attributes and methods of a Fulfillment model.<br>
 * A Fulfillment is the relationship between a Skill and a Member that fulfills that Skill.<br>
 * Based on the Laravel's Eloquent.<br>
 * 
 * @author generated with Laravel Schema Designer <laravelsd.com>
 */
class Fulfillment extends \Eloquent {

    use SimplePivotModelTrait;

    protected $table = 'fulfillments';
    protected $hidden = ['member_id', 'skill_id'];

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
     * Validations rules for creating a new Fulfillment.
     * @var array 
     */
    public static $create_rules = [
        'member_id' => 'integer|required|min:1|exists:members,id',
        'skill_id' => 'integer|required|min:1|exists:skills,id',
    ];

    /**
     * Get the Skill to which a Fulfillment is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function skill() {
        return $this->belongsTo('Rockit\Skill')->withTrashed();
    }

}
