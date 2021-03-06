<?php

namespace Rockit\Models;

use Rockit\Traits\Models\ModelBCRDTrait,
    Illuminate\Database\Eloquent\SoftDeletingTrait;

/**
 * Contains the attributes and methods of a Gift model in the database.<br>
 * A Gift is offered in an Event, but an Event is not obliged to offer a Gift.<br>
 * Based on the Laravel's Eloquent.<br>
 * 
 * @author generated with Laravel Schema Designer <laravelsd.com>
 * @author Robert di Rosa <robert.dirosa@heig-vd.ch>
 */
class Gift extends \Eloquent {

    use SoftDeletingTrait,
        ModelBCRDTrait;

    protected $table = 'gifts';
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
     * Validations rules for creating a new Gift.
     * @var array 
     */
    public static $create_rules = array(
        'name_de' => 'required',
    );

    /**
     * Get the Events to which a Gift is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function events() {
        return $this->belongsToMany('Rockit\Models\Event')->withPivot('quantity', 'cost', 'comment_de');
    }

}
