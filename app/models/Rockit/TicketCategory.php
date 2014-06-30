<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait,
    Rockit\Models\ModelBCRDTrait;

class TicketCategory extends \Eloquent {

    use SoftDeletingTrait,
        ModelBCRDTrait;

    protected $table = 'ticket_categories';
    protected $dates = ['deleted_at'];
    protected $hidden = ['deleted_at'];
    public $timestamps = false;
    public static $response_field = 'name_de';
    public static $create_rules = array(
        'name_de' => 'required',
    );

    public function events() {
        return $this->belongsToMany('Rockit\Event')->withPivot('ammount', 'comment_de', 'quantity_sold');
    }

}
