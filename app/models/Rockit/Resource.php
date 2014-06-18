<?php

namespace Rockit;

use \Eloquent;

class Resource extends Eloquent {

    public $timestamps = true;
    protected $table = 'resources';
    protected $dates = ['deleted_at'];

    public function groups() {
        return $this->belongsToMany('Group');
    }

}
