<?php

namespace Rockit;

use Rockit\Models\ModelBCUDTrait,
    Rockit\Models\Functions\RestoreOneTrait;

class Language extends \Eloquent {

    use ModelBCUDTrait,
        RestoreOneTrait;

    protected $table = 'languages';
    public $timestamps = false;
    public static $create_rules = array(
        'locale' => 'alpha|required|min:2|max:2',
        'name' => 'alpha|required|min:2',
    );
    public static $update_rules = array(
        'locale' => 'alpha|min:2|max:2|required',
        'name' => 'alpha|min:2',
    );

    public function users() {
        return $this->hasMany('Rockit\User');
    }

}
