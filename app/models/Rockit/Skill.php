<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait,
    Rockit\Models\ModelBCRDTrait;

/**
 * Contains the attributes and methods of a Skill model in the database.<br>
 * A Skill is fulfilled by a Member and can be needed for an Event.<br>
 * The Member must be considered Staff to execute a Skill in an Event that needs that Skill.<br>
 * Based on the Laravel's Eloquent.<br>
 * 
 * @author ??
 */
class Skill extends \Eloquent {

    use SoftDeletingTrait,
        ModelBCRDTrait;

    protected $table = 'skills';
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
     * Validations rules for creating a new Skill.
     * @var array 
     */
    public static $create_rules = array(
        'name_de' => 'required|min:1',
    );

    /**
     * Get the Members to which a Skill is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function members() {
        return $this->belongsToMany('Rockit\Member', 'fulfillments');
    }

    /**
     * Get the Events to which a Skill is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function events() {
        return $this->belongsToMany('Rockit\Event', 'needs')->withPivot('nb_people');
    }

    /**
     * Get the Staffs to which a Skill is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function staffs() {
        return $this->hasMany('Rockit\Staff');
    }

}
