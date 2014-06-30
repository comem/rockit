<?php

namespace Rockit;

class Instrument extends \Eloquent {

    use \Illuminate\Database\Eloquent\SoftDeletingTrait,
        Models\ModelBCRDTrait;

    public $timestamps = false;
    protected $table = 'instruments';
    public static $response_field = 'name_de';
    public static $create_rules = array(
        'name_de' => 'required|min:1',
    );

    public function lineups() {
        return $this->hasMany('Rockit\Lineup');
    }

}
