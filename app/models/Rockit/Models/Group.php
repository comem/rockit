<?php

namespace Rockit\Models;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

/**
 * Contains the attributes and methods of a Group model in the database.<br>
 * A Group can act on Resources, and a Group can contain Users. Groups form part of the application's Access Control Layer.<br>
 * Based on the Laravel's Eloquent.<br>
 * 
 * @author generated with Laravel Schema Designer <laravelsd.com>
 * @author Mathias Oberson <mathias.oberson@heig-vd.ch>
 */
class Group extends \Eloquent {

    use SoftDeletingTrait;

    protected $table = 'groups';
    protected $dates = ['deleted_at'];

    /**
     * Indicates whether this model uses laravel's timestamps.
     * @var boolean 
     */
    public $timestamps = true;

    // protected $hidden = array('deleted_at', 'created_at', 'updated_at', 'group_id');

    /**
     * Get the Group from which this Group inherits
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function groupParent() {
        return $this->hasOne('Rockit\Models\Group', 'id', 'group_id');
    }

    /**
     * Get the Resources to which a Group is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function resources() {
        return $this->belongsToMany('Rockit\Models\Resource');
    }

    /**
     * Get the Users to which a Group is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function users() {
        return $this->hasMany('Rockit\Models\User');
    }

    /**
     * Check if the current Group has access to the provided Resource.
     * @return boolean
     */
    public function hasAccess(Resource $resource) {
        $access = $this->resources->contains($resource->id);
        if ($this->group_id && !$access) {
            $access = $this->group_parent->hasAccess($resource);
        }
        return $access;
    }

}
