<?php

namespace Rockit;

class Link extends \Eloquent {

    use Models\ModelBCUDTrait;

    protected $table = 'links';
    protected $hidden = ['artist_id'];
    public $timestamps = false;
    public static $response_field = 'url';
    public static $create_rules = array(
        'url' => 'required|url|max:400|unique:links',
        'name_de' => 'required|max:200',
        'title_de' => 'max:50',
        'artist_id' => 'required|integer|max:10|exists:artists,id',
    );
    public static $update_rules = array(
        'url' => 'url|required|max:400',
        'name_de' => 'required|max:200',
        'title_de' => 'max:50',
    );

    public function artist() {
        return $this->belongsTo('Rockit\Artist');
    }

}
