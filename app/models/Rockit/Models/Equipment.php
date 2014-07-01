<?php

namespace Rockit\Models;

use Rockit\Traits\Models\ModelBCRDTrait,
    Illuminate\Database\Eloquent\SoftDeletingTrait;

/**
 * Contains the attributes and methods of an Equipment model in the database.<br>
 * An Equipment can be attributed to an Event as a Reserved piece of equipment.<br>
 * Based on the Laravel's Eloquent.<br>
 * 
 * @author generated with Laravel Schema Designer <laravelsd.com>
 */
class Equipment extends \Eloquent {

    use SoftDeletingTrait,
        ModelBCRDTrait;

    protected $table = 'equipments';
    protected $dates = ['deleted_at'];
    protected $hidden = ['deleted_at'];

    /**
     * Indicates whether this model uses laravel's timestamps.
     * @var boolean 
     */
    public $timestamps = false;

    /**
     * Indicates which field value should be used in the return messages.
     * @var string 
     */
    public static $response_field = 'name_de';

    /**
     * Validations rules for creating a new Equipment.
     * @var array 
     */
    public static $create_rules = array(
        'name_de' => 'required',
    );

    /**
     * Get the Events to which an Equipment is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function events() {
        return $this->belongsToMany('Rockit\Models\Event')->withPivot('quantity', 'cost');
    }

}
