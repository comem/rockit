<?php

use Rockit\Resource,
    Illuminate\Auth\UserTrait,
    Illuminate\Auth\UserInterface,
    Illuminate\Auth\Reminders\RemindableTrait,
    Illuminate\Auth\Reminders\RemindableInterface,
    Illuminate\Database\Eloquent\SoftDeletingTrait,
    Rockit\RockitModelTrait;

class User extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait,
        RemindableTrait,
        SoftDeletingTrait,
        RockitModelTrait;

    public $timestamps = true;
    protected static $rules = array(
        'email' => 'email|max:300|unique:users',
        'password' => 'min:4|max:2000'
    );

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    /**
     * Static function to validate User data
     * @param array('email', 'password') to valid these data
     * @return boolean true if data is validated, false if not
     */
    public static function validate($data = array()) {
        $v = Validator::make($data, self::$rules);
        return $v->passes();
    }

    public function group() {
        return $this->belongsTo('Rockit\Group');
    }

    public function language() {
        return $this->belongsTo('Rockit\Language');
    }

    public function hasAccess(Resource $resource) {
        return $this->group->hasAccess($resource);
    }

}
