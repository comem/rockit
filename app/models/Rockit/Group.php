<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use \Eloquent;

class Group extends Eloquent {

    protected $table = 'groups';
    public $timestamps = true;

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    public function groupParent() {
        return $this->hasOne('Group');
    }

    public function resources() {
        return $this->belongsToMany('Ressources');
    }

    public function users() {
        return $this->hasMany('User');
    }

}
