<?php

namespace Rockit;

use Rockit\Models\ModelBCRDTrait,
    Illuminate\Database\Eloquent\SoftDeletingTrait;

class Equipment extends \Eloquent {

    use SoftDeletingTrait,
        ModelBCRDTrait;

    protected $table = 'equipments';
    protected $dates = ['deleted_at'];
    protected $hidden = ['deleted_at'];
    public $timestamps = false;
    public static $response_field = 'name_de';
    public static $create_rules = array(
        'name_de' => 'required',
    );

    public function events() {
        return $this->belongsToMany('Rockit\Event')->withPivot('quantity', 'cost');
    }

}
