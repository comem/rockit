<?php

namespace Rockit;

use Rockit\Models\ModelBCUDTrait,
    Illuminate\Database\Eloquent\SoftDeletingTrait;

class Member extends \Eloquent {

    use SoftDeletingTrait,
        ModelBCUDTrait;

    public $timestamps = true;
    protected $table = 'members';
    protected $dates = ['deleted_at'];
    public static $response_field = "first_name";

    /**
     * Validations rules for creating a new Member.
     * @var array 
     */
    public static $create_rules = array(
        'first_name' => 'required|min:1|max:100|names',
        'last_name' => 'required|min:1|max:100|names',
        'email' => 'email|min:1|max:200|required_without:phone',
        'phone' => 'phone|min:1|max:20|required_without:email',
        'is_active' => 'required|boolean',
        'street' => 'required|min:1|max:200',
        'npa' => 'required|min:1|max:20',
        'city' => 'min:1|max:200',
    );
    public static $update_rules = [];

    public function skills() {
        return $this->belongsToMany('Rockit\Skill', 'fulfillments');
    }

    public function events() {
        return $this->belongsToMany('Rockit\Event', 'staffs');
    }

    public function staffs() {
        return $this->hasMany('Rockit\Staff');
    }

    public function fulfillments() {
        return $this->hasMany('Rockit\Fulfillment');
    }

}
