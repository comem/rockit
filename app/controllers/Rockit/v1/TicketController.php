<?php

namespace Rockit\v1;

use \Input,
    \Jsend,
    \Rockit\Ticket,
    Rockit\Controllers\CompletePivotControllerTrait;

/**
 * Contains interaction methods to the TicketCategory model in the database.<br>
 * A Ticket is proposed in an Event and proposes a Ticket Category.<br>
 * Based on the Laravel's BaseController.<br>
 * Can : <b>store</b>, <b>update</b> and <b>destroy</b> an association between a Ticket Category and an Event.<br>
 * 
 * //////////////////////////////////////// take off from here
 * @author Joël Gugger <joel.gugger@heig-vd.ch>
 */
class TicketController extends \BaseController {

    use CompletePivotControllerTrait;

    /**
     * Store a new association between a Ticket Category and the Event it illustrates.
     * 
     * Get the adequate inputs from the client request and test that each of them pass the validation rules.<br>
     * If any of these inputs fails, a <b>Jsend::fail</b> is returned.<br>
     * If all the inputs are valid, the data is then passed to the <b>save()</b> method, who sends back a response.<br>
     *
     * @return Jsend
     */
    public function store() {
        $data = Input::only('amount', 'quantity_sold', 'comment_de', 'event_id', 'ticket_category_id');
        $response = Ticket::validate($data, Ticket::$create_rules);
        if ($response === true) {
            $response = self::save('Ticket', $data);
        }
        return Jsend::compile($response);
    }

    /**
     * Save a new relationship between an existing TicketCategory and an existing Event with the given inputs.
     * 
     * The TicketCategory provided in the inputs must illustrate an Artist that performs in the Event provided.<br>
     * If the TicketCategory does not illustrate a performing Artist in the Event, a <b>Jsend::fail</b> is returned.
     * If the TicketCategory provided already symbolizes an Event, a <b>Jsend::fail</b> is returned.<br>
     * Or else the inputs are passed to the <b>updateOne</b> method of the TicketCategory model.<br>
     *
     * @param array $inputs An array containing a valid ticket category id and a valid event id 
     * @return Jsend
     */
    public function update($id) {
        $data = Input::only('amount', 'quantity_sold', 'comment_de');
        $response = Ticket::validate($data, Ticket::$update_rules);
        if ($response === true) {
            $response = self::modify('Ticket', $id, $data);
        }
        return Jsend::compile($response);
    }

    /**
     * Destroys the association between a Ticket Category and an Event, from the provided ticket category id.
     *
     * If the ticket category id does not point to an existing TicketCategory, a <b>Jsend::fail</b> is returned.<br>
     * Or else the the TicketCategory is passed to the <b>delete()</b> method.<br>
     * 
     * 
     * @param int $id The id of the TicketCategory that will no longer symbolize an Event
     * @return Jsend
     */
    public function destroy($id) {
        return Jsend::compile(self::delete($id));
    }

    /**
     * Remove a relationship between an existing TicketCategory and an existing Event, from the provided TicketCategory.
     *
     * If the TicketCategory provided does not symbolize an Event, a <b>Jsend::fail</b> is returned.<br>
     * If the delete was not completed, a <b>Jsend::error</b> is returned.<br>
     * Or else a <b>Jsend::success</b> is returned.<br>
     * 
     * @param TicketCategory $ticket category The TicketCategory that smybolizes an Event, whose association is to be deleted
     * @return array Contains an array with either a <b>fail</b>, <b>error</b> or <b>success</b> key and its corresponding message
     */
    public static function delete($id) {
        $object = Ticket::exist($id);
        if ($object == null) {
            $response = array(
                'fail' => array(
                    'title' => trans('fail.ticket.inexistant'),
                ),
            );
        } else {
            $response = Ticket::isLastTicket($object);
            if ($response === false) {
                $response = Ticket::deleteOne($object);
            }
        }
        return $response;
    }

}
