<?php

namespace Rockit;

use Rockit\Models\ModelBCUDTrait,
    Illuminate\Database\Eloquent\SoftDeletingTrait;

/**
 * Contains the attributes and methods of a Representer model in the database.<br>
 * A Representer can guarantee an Event and plays an administrative role in the organisation.<br>
 * Based on the Laravel's Eloquent.<br>
 * 
 * @author generated with Laravel Schema Designer <laravelsd.com>
 */
class Representer extends \Eloquent {

    use SoftDeletingTrait,
        ModelBCUDTrait;

    protected $table = 'representers';
    protected $hidden = array('deleted_at', 'created_at', 'updated_at');
    protected $dates = array('deleted_at');

    /**
     * Indicates whether this model uses laravel's timestamps.
     * @var boolean 
     */
    public $timestamps = true;

    /**
     * Indicates which field value should be used in the return messages.
     * @var string 
     */
    public static $response_field = 'first_name';

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

    /**
     * Get the Events to which a Representer is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function events() {
        return $this->hasMany('Rockit\Event');
    }

    /**
     * Reduce the scope of the provided list of results, using a 'name' search filter.
     * @param \Illuminate\Database\Query\Builder $query The query on which the scope will be applied
     * @param string $name A string that must be contained in the name attribute
     * @return ?\Illuminate\Database\Eloquent\Collection?
     */
    public function scopeName($query, $name) {
        return $query->where('name', 'LIKE', '%' . $name . '%');
    }

}
