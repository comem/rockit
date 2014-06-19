<?php

namespace Rockit;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use \Eloquent;

class User extends Eloquent implements UserInterface {

    use UserTrait,
        SoftDeletingTrait;

    public $timestamps = true;
    protected $table = 'users';
    protected $dates = array('deleted_at');
    protected $hidden = array('password');

    public function group() {
        return $this->belongsTo('Rockit\Group');
    }

    public function language() {
        return $this->belongsTo('Rockit\Language');
    }

}
