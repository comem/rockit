<?php

namespace Rockit;

class Instrument extends \Eloquent {

    use \Illuminate\Database\Eloquent\SoftDeletingTrait,
        Models\ModelBCRDTrait;

    protected $table = 'instruments';
    public $timestamps = false;
    public static $create_rules = array(
        'name_de' => 'required|min:1',
    );

    public function lineups() {
        return $this->hasMany('Rockit\Lineup');
    }

}
