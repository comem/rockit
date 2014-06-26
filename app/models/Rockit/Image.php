<?php

namespace Rockit;

use Rockit\Models\ModelBCUDTrait,
    Illuminate\Database\Eloquent\SoftDeletingTrait;

class Image extends \Eloquent {

    use SoftDeletingTrait,
        ModelBCUDTrait;

    public static $create_rules = array(
        'source' => 'required|min:1|max:2000',
        'alt_de' => 'max:100',
        'caption_de' => 'max:200',
    );
    public static $update_rules = array(
        'source' => 'min:1|max:2000',
        'alt_de' => 'max:100',
        'caption_de' => 'max:200',
    );
    public $timestamps = true;
    protected $table = 'images';
    protected $hidden = array('deleted_at');
    protected $dates = array('deleted_at');
    public static $response_field = 'id';

    public function artist() {
        return $this->belongsTo('Rockit\Artist');
    }

}
