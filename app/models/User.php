<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait,
        RemindableTrait;

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
        $v = Validator::make($data, User::$rules);
        return $v->passes();
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier() {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword() {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     * @return string
     */
    public function getReminderEmail() {
        return $this->email;
    }

    /**
     * Get the token value for the "remember me" session.
     */
    public function getRememberToken() {
        // not implemented yet
    }

    /**
     * Get the column name for the "remember me" token.
     */
    public function getRememberTokenName() {
        // not implemented yet
    }

    /*
     * Set the token value for the "remember me" session.
     */
    public function setRememberToken($value) {
        // not implemented yet
    }

}
