<?php

namespace Rockit;

use Rockit\Models\CompletePivotModelTrait;

class Ticket extends \Eloquent {

	use CompletePivotModelTrait;

	protected $table = 'tickets';

	public $timestamps = false;
	public static $create_rules = [
		'amount' 				=> 'integer|required|min:0',
		'quantity_sold'			=> 'integer|min:0',
		'comment_de' 			=> 'min:1',
		'event_id' 				=> 'integer|required|min:1|exists:events,id',
		'ticket_category_id'	=> 'integer|required|min:1|exists:ticket_categories,id',
	];
	public static $update_rules = [
		'amount' 			=> 'integer|min:0',
		'quantity_sold'		=> 'integer|min:0',
		'comment_de' 		=> 'min:1',
	];
	public static $response_field = 'id';

}
