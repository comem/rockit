<?php

namespace Rockit;

use Rockit\Models\ModelBCUDTrait,
    Illuminate\Database\Eloquent\SoftDeletingTrait;

/**
 * Contains the attributes and methods of a Member model in the database.<br>
 * A Member can be employed in an Event as Staff.<br>
 * This is possibile if certain conditions are respected. The conditions concern the Needs of an Event. Alos the Member can only execute a Skill that he can Fulfill.<br>
 * Based on the Laravel's Eloquent.<br>
 * 
 * @author generated with Laravel Schema Designer <laravelsd.com>
 */
class Member extends \Eloquent {

    use SoftDeletingTrait,
        ModelBCUDTrait;

    protected $table = 'members';
    protected $hidden = ['created_at', 'updated_at'];
    protected $dates = ['deleted_at'];

    /**
     * Indicates whether this model uses laravel's timestamps.
     * @var boolean 
     */
    public $timestamps = true;

    /**
     * Indicates which field value should be used in the return messages.
     * @var string 
     */
    public static $response_field = "first_name";

    /**
     * Validations rules for creating a new Member.
     * @var array 
     */
    public static $create_rules = array(
        'first_name' => 'required|min:1|max:100|names',
        'last_name' => 'required|min:1|max:200|names',
        'email' => 'email|min:1|max:300|required_without:phone',
        'phone' => 'phone|min:8|max:30|required_without:email',
        'is_active' => 'required|boolean',
        'street' => 'required|min:1|max:300',
        'npa' => 'required|min:1|max:10',
        'city' => 'required|min:1|max:100',
        'country' => 'min:1|max:100'
    );

    /**
     * Validation rules for updating an existing Member.
     * @var array 
     */
    public static $update_rules = [
        'first_name' => 'min:1|max:100|names',
        'last_name' => 'min:1|max:200|names',
        'email' => 'email|min:1|max:300',
        'phone' => 'phone|min:8|max:30',
        'is_active' => 'boolean',
        'street' => 'min:1|max:300',
        'npa' => 'min:1|max:10',
        'city' => 'min:1|max:100',
        'country' => 'min:1|max:100'
    ];

    /**
     * Get the Skills to which a Member is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function skills() {
        return $this->belongsToMany('Rockit\Skill', 'fulfillments');
    }

    /**
     * Get the Events to which a Member is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function events() {
        return $this->belongsToMany('Rockit\Event', 'staffs');
    }

    /**
     * Get the Staffs to which a Member is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function staffs() {
        return $this->hasMany('Rockit\Staff');
    }

    /**
     * Get the Fulfillments to which a Member is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fulfillments() {
        return $this->hasMany('Rockit\Fulfillment');
    }

}
