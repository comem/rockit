<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Group extends Eloquent {

    protected $table = 'groups';
    public $timestamps = true;

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    public function parent() {
        return $this->hasOne('Group');
    }

    public function resources() {
        return $this->belongsToMany('Ressources');
    }

    public function users() {
        return $this->hasMany('User');
    }

}
