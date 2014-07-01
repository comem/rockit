<?php

namespace Rockit;

/**
 * Contains the attributes and methods of a Resource model in the database.<br>
 * A Resource is acted on by Groups, and a Group can contain Users. Resources form part of the application's Access Control Layer.<br>
 * Based on the Laravel's Eloquent.<br>
 * 
 * @author generated with Laravel Schema Designer <laravelsd.com>
 */
class Resource extends \Eloquent {

    public $timestamps = true;
    protected $table = 'resources';
    protected $dates = ['deleted_at'];

    public function groups() {
        return $this->belongsToMany('Group');
    }

}
