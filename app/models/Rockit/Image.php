<?php

namespace Rockit;

use Models\ModelBCUDTrait,
    Illuminate\Database\Eloquent\SoftDeletingTrait;

class Image extends \Eloquent {

    use SoftDeletingTrait,
        ModelBCUDTrait;

    public static $create_rules = array(
        ''
    );
    public $timestamps = true;
    protected $table = 'images';
    protected $hidden = array('deleted_at');
    protected $dates = array('deleted_at');

    public function artist() {
        return $this->belongsTo('Rockit\Artist');
    }

}
