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
        return $this->hasOne('Rockit\Group');
    }

    public function resources() {
        return $this->belongsToMany('Rockit\Resource');
    }

    public function users() {
        return $this->hasMany('Rockit\User');
    }

    public function hasAccess($controller, $method) {
        $resource_id = Resource::where('controller', '=', $controller)
        ->where('method', '=', $method)
        ->first()
        ->id;
        return $resource_id;
    }

}
