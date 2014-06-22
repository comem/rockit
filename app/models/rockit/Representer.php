<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Representer extends \Eloquent {
    
    use SoftDeletingTrait,
        RockitModelTrait;

    public $timestamps = true;
    protected $table = 'representers';
    protected $hidden = array('deleted_at', 'created_at', 'updated_at');
    protected $dates = array('deleted_at');

    /**
     * Get all the events that this Representer represents.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function events() {
        return $this->hasMany('Rockit\Event');
    }

    /**
     * Validations rules for creating a new Representer.
     * @var array 
     */
    public static $create_rules = array(
        'first_name' => 'required|min:1|max:100|names',
        'last_name' => 'required|min:1|max:100|names',
        'email' => 'email|min:1|max:200|required_without:phone',
        'phone' => 'phone|min:1|max:20|required_without:email',
        'street' => 'min:1|max:200',
        'npa' => 'min:1|alpha_dash|max:20',
        'city' => 'min:1|max:200',
    );

    /**
     * Validation rules for updating an existing Representer.
     * @var array 
     */
    public static $update_rules = array(
        'first_name' => 'min:1|max:100|names',
        'last_name' => 'min:1|max:100|names',
        'email' => 'email|min:1|max:200',
        'phone' => 'phone|min:1|max:20',
        'street' => 'min:1|max:200',
        'npa' => 'alpha_dash|min:1|max:20',
        'city' => 'min:1|max:200',
    );

}
