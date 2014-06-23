<?php

namespace Rockit;

class Link extends \Eloquent {
    
    use Models\ModelBCUDTrait;

    protected $table = 'links';
    public $timestamps = false;

    public function artist() {
        return $this->belongsTo('Rockit\Artist');
    }

}
