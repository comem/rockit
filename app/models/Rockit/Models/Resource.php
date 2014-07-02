<?php

namespace Rockit\Models;

/**
 * Contains the attributes and methods of a Resource model in the database.<br>
 * A Resource is acted on by Groups, and a Group can contain Users. Resources form part of the application's Access Control Layer.<br>
 * Based on the Laravel's Eloquent.<br>
 * 
 * @author generated with Laravel Schema Designer <laravelsd.com>
 * @author Mathias Oberson <mathias.oberson@heig-vd.ch>
 */
class Resource extends \Eloquent {

    /**
     * Indicates whether this model uses laravel's timestamps.
     * @var boolean 
     */
    public $timestamps = true;
    protected $table = 'resources';
    protected $dates = ['deleted_at'];

    /**
     * Get the Groups to which a Resource is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function groups() {
        return $this->belongsToMany('Rockit\Models\Group');
    }

}
