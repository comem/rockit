<?php

namespace Rockit;

use Rockit\Models\CompletePivotModelTrait;

/**
 * Contains the attributes and methods of a Printing model.<br>
 * A Printing is the relationship between an Event and a PrintingType that is printed for that Event.<br>
 * Based on the Laravel's Eloquent.<br>
 * 
 * @author ??
 */
class Printing extends \Eloquent {

    use CompletePivotModelTrait;

    protected $table = 'printings';
    protected $hidden = ['printing_type_id', 'event_id'];

    /**
     * Indicates whether this model uses laravel's timestamps.
     * @var boolean 
     */
    public $timestamps = false;
    
    /**
     * Indicates which field value should be used in the return messages.
     * @var string 
     */
    public static $response_field = 'id';

    /**
     * Validations rules for creating a new Printing.
     * @var array 
     */
    public static $create_rules = [
        'nb_copies' => 'integer|required|min:0',
        'nb_copies_surplus' => 'integer|min:0',
        'event_id' => 'integer|required|min:1|exists:events,id',
        'printing_type_id' => 'integer|required|min:1|exists:printing_types,id',
        'source' => 'required|path:printings|max:100|min:1|unique:printings',
    ];

    /**
     * Validation rules for updating an existing Printing.
     * @var array 
     */
    public static $update_rules = [
        'nb_copies' => 'integer|min:0',
        'nb_copies_surplus' => 'integer|min:0',
        'source' => 'path:printings|max:100|min:1|unique:printings',
    ];

    /**
     * Get the PrintingType to which a Printing is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function printingType() {
        return $this->belongsTo('Rockit\PrintingType');
    }

    /**
     * Get the Events to which a Printing is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function event() {
        return $this->belongsTo('Rockit\Event');
    }

}
