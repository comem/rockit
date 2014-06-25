<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Image extends \Eloquent {

    use SoftDeletingTrait;

    public $timestamps = true;
    protected $table = 'images';
    protected $hidden = array('deleted_at');
    protected $dates = array('deleted_at');

    public function artist() {
        return $this->belongsTo('Rockit\Artist');
    }

}
