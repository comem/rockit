<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait,
    Rockit\Models\ModelBCRDTrait;

/**
 * Contains the attributes and methods of a PrintingType model in the database.<br>
 * A PrintingType is printed for an Event. An Event has no obligation to be printed on a PrintingType.
 * This is used for promotional reasons by the organisation.<br>
 * Based on the Laravel's Eloquent.<br>
 * 
 * @author generated with Laravel Schema Designer <laravelsd.com>	
 */
class PrintingType extends \Eloquent {

    use SoftDeletingTrait,
        ModelBCRDTrait;

    protected $table = 'printing_types';
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
     * Validations rules for creating a new PrintingType.
     * @var array 
     */
    public static $create_rules = array(
        'name_de' => 'required',
    );

    /**
     * Get the Events to which a PrintingType is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function events() {
        return $this->belongsToMany('Rockit\Event')->withPivot('source', 'nb_copies', 'nb_copies_surplus');
    }

}
