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
        return $this->hasOne('Rockit\Group', 'id', 'group_id');
    }

    public function resources() {
        return $this->belongsToMany('Rockit\Resource');
    }

    public function users() {
        return $this->hasMany('Rockit\User');
    }

    public function hasAccess(Resource $resource) {
        $access = $this->resources->contains($resource->id);
        if ($this->group_id && !$access) {
            $access = $this->group_parent->hasAccess($resource);
        }
        return $access;
    }

}
