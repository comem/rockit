<?php

namespace Rockit;

use Rockit\Models\CompletePivotModelTrait;

/**
 * Contains the attributes and methods of a Ticket model.<br>
 * A Ticket is the relationship between an Event and a PrintingType that is printed for that Event.<br>
 * Based on the Laravel's Eloquent.<br>
 * 
 * @author generated with Laravel Schema Designer <laravelsd.com>
 * @author Joël Gugger <joel.gugger@heig-vd.ch>
 */
class Ticket extends \Eloquent {

	use CompletePivotModelTrait;

	protected $table = 'tickets';

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
     * Validations rules for creating a new Ticket.
     * @var array 
     */
	public static $create_rules = [
		'amount' 				=> 'integer|required|min:0',
		'quantity_sold'			=> 'integer|min:0',
		'comment_de' 			=> 'min:1',
		'event_id' 				=> 'integer|required|min:1|exists:events,id',
		'ticket_category_id'	=> 'integer|required|min:1|exists:ticket_categories,id',
	];


	/**
     * Validation rules for updating an existing Ticket.
     * @var array 
     */
	public static $update_rules = [
		'amount' 			=> 'integer|min:0',
		'quantity_sold'		=> 'integer|min:0',
		'comment_de' 		=> 'min:1',
	];

	/**
        * Validation rules for associating a new Event with a new Ticket.
        * @var array 
	*
	*/
	public static $create_event_rules = [
		'amount' 				=> 'integer|required|min:0',
		'quantity_sold'			=> 'integer|min:0',
		'comment_de' 			=> 'min:1',
		'ticket_category_id'	=> 'integer|required|min:1|exists:ticket_categories,id',
	];


	/**
     * Get the TicketCategory to which a Ticket is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
	public function ticketCategory()
	{
		return $this->belongsTo('Rockit\TicketCategory');
	}

	/**
     * Get the Events to which a Ticket is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
	public function event()
	{
		return $this->belongsTo('Rockit\Event');
	}

	/**
	 * Check if the Event corresponding to the provided event id proposes only one, last Ticket.
	 *
	 * If this is the last Ticket for the Event corresponding to the provided event id, a <b>Jsend:fail</b> is returned.<br>
     * Or else a boolean 'false' is returned.<br>
     * 
	 * @return a boolean 'false' or a Jsend:fail message
	 */
	public static function isLastTicket($object){
		$response = false;
		$tickets = Ticket::where('event_id', '=', $object->event_id)->count();
		if($tickets < 2){
			$response = array(
                'fail' => array(
                    'title' => trans('fail.ticket.last_ticket'),
                ),
            );
		}
		return $response;
	}

	public static function isTicketCategoryUnicity( array $ticket_categories ){
		$newTab = [];
		foreach( $ticket_categories as $ticket_category ){
			if( !in_array($ticket_category['ticket_category_id'], $newTab) ){
				$newTab[] = $ticket_category['ticket_category_id'];
			}
		}
		return count( $ticket_categories ) === count( $newTab );
	}

}
