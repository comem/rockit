<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Group extends \Eloquent {

    use SoftDeletingTrait;

    public $timestamps = true;
    protected $table = 'groups';
    protected $dates = ['deleted_at'];
    // protected $hidden = array('deleted_at', 'created_at', 'updated_at', 'group_id');

    /**
     * Get the group from which this instance inherits
     * @return type
     */
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
