<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Representer extends \Eloquent {

    public $timestamps = true;
    protected $table = 'representers';

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    public function events() {
        return $this->hasMany('Rockit\Event');
    }

    public static $create_rules = array(
        'first_name' => 'required|min:1|max:100|names',
        'last_name' => 'required|min:1|max:100',
        'email' => 'email|min:1|max:200|required_without:phone',
        'phone' => 'phone|max:20|required_without:email',
        'street' => 'max:200',
        'npa' => 'alpha_dash|max:20',
        'city' => 'max:200',
    );
    public static $update_rules = array(
    );

}
