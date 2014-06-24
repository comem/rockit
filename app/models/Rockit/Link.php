<?php

namespace Rockit;

class Link extends \Eloquent {

    use Models\ModelBCUDTrait;

    protected $table = 'links';
    public $timestamps = false;
    public static $create_rules = array(
        'url' => 'required|url|unique:links',
        'name_de' => '',
        'title_de' => '',
        'artist_id' => 'required|integer|min:0|exists:artists,id',
    );

    public function artist() {
        return $this->belongsTo('Rockit\Artist');
    }

}
