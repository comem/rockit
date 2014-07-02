<?php

namespace Rockit\Models;

use Rockit\Traits\Models\ModelBCRDTrait,
    Illuminate\Database\Eloquent\SoftDeletingTrait;

/**
 * Contains the attributes and methods of a TicketCategory model in the database.<br>
 * A TicketCategory is proposed in an Event, and each TicketCategory must be proposed in atleast one Event.<br>
 * Based on the Laravel's Eloquent.<br>
 * 
 * @author generated with Laravel Schema Designer <laravelsd.com>
 */
class TicketCategory extends \Eloquent {

    use SoftDeletingTrait,
        ModelBCRDTrait;

    protected $table = 'ticket_categories';
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
     * Validations rules for creating a new TicketCategory.
     * @var array 
     */
    public static $create_rules = array(
        'name_de' => 'required',
    );

    /**
     * Get the Events to which a TicketCategory is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function events() {
        return $this->belongsToMany('Rockit\Models\Event')->withPivot('ammount', 'comment_de', 'quantity_sold');
    }

}
