<?php

namespace Rockit;

/**
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
