<?php

use Rockit\Resource,
    Rockit\Models\Functions\UpdateOneTrait,
    Illuminate\Auth\UserTrait,
    Illuminate\Auth\UserInterface,
    Illuminate\Auth\Reminders\RemindableTrait,
    Illuminate\Auth\Reminders\RemindableInterface,
    Illuminate\Database\Eloquent\SoftDeletingTrait;

/**
 * Contains the attributes and methods of an User model in the database.<br>
 * A User us contained in a Group that can act on Resources. Users form part of the application's Access Control Layer.<br>
 * Based on the Laravel's Eloquent.<br>
 * 
 * @author ??
 */
class User extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait,
        RemindableTrait,
        SoftDeletingTrait,
        UpdateOneTrait;

    protected $appends = array('language', 'group');
    protected $table = 'users';
    protected $hidden = array(
        'password',
        'remember_token',
        'language_id',
        'group_id',
//        'deleted_at',
//        'created_at',
//        'updated_at',
    );

    /**
     * The rules to validate a User.
     * @var array 
     */
    protected static $rules = array(
        'email' => 'email|max:300|unique:users',
        'password' => 'min:4|max:2000'
    );


    /**
     * Indicates whether this model uses laravel's timestamps.
     * @var boolean 
     */
    public $timestamps = true;

    /**
     * Indicates which field value should be used in the return messages.
     * @var string 
     */
    public static $response_field = 'first_name';

    /**
     * Validate a User from the email and password provided.
     * @param array('email', 'password') to be validated
     * @return boolean whether User is valid or not
     */
    public static function validate($data = array()) {
        $v = Validator::make($data, self::$rules);
        return $v->passes();
    }

    /**
     * Get the Group to which an User is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function group() {
        return $this->belongsTo('Rockit\Group');
    }

    /**
     * Get the Language to which an User is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function language() {
        return $this->belongsTo('Rockit\Language');
    }


    public function hasAccess(Resource $resource) {
        return $this->group->hasAccess($resource);
    }


    protected function getLanguageAttribute() {
        return $this->language()->getResults();
    }


    protected function getGroupAttribute() {
        return $this->group()->getResults();
    }

}
