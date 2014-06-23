<?php

namespace Rockit;

class Description extends \Eloquent {

    use Models\SimplePivotModelTrait;

    public $timestamps = false;
    protected $table = 'descriptions';
    public static $rules = array(
        'artist_id' => 'required|integer|min:1',
        'genre_id' => 'required|integer|min:1',
    );

}
