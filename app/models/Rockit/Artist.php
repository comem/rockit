<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Artist extends \Eloquent {

    use Models\ModelBCUDTrait;
    
    protected $table = 'artists';
    public $timestamps = true;

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    public function links() {
        return $this->hasMany('Rockit\Link');
    }

    public function genres() {
        return $this->belongsToMany('Rockit\Genre', 'descriptions');
    }

    public function images() {
        return $this->hasMany('Rockit\Image');
    }

    public function lineups() {
        return $this->hasMany('Rockit\Lineup');
    }

    public function events() {
        return $this->belongsToMany('Rockit\Event')->withPivot('order', 'is_support', 'artist_hour_of_arrival');
    }

}
