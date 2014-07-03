<?php

namespace Rockit\Controllers\v1;

use \Input,
    Rockit\Helpers\Jsend,
    \Rockit\Models\Ticket,
    \Rockit\Traits\Controllers\CompletePivotControllerTrait;

/**
 * A Ticket is proposed in an Event and proposes a Ticket Category.<br>
 * Contains interaction methods to the TicketCategory model in the database.<br>
 * Based on the Laravel's BaseController.<br>
 * Can : <b>store</b>, <b>update</b> and <b>destroy</b> an association between a Ticket Category and an Event.<br>
 * 
 * @author Joël Gugger <joel.gugger@heig-vd.ch>
 */
class TicketController extends \BaseController {

    use CompletePivotControllerTrait;

    /**
     * Store a new association between a TicketCategory and an Event that it is proposed for.
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
     * Update the association between an Event and a proposed TicketCategory that corresponds to the provided ticket id, with the provided inputs.
     *
     * Get the adequate inputs from the client request and test that each of them pass the update validation rules.<br>
     * Modifies the Ticket that matches the provided id by passing this id to the <b>modify()</b> method, who sends back a response.<br>
     * 
     * @param int $id The id of the requested Ticket
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
     * Destroy the association between a TicketCategory and an Event that proposes that TicketCategory, corresponding to the provided ticket category id.
     *
     * Destroys the TicketCategory that matches the provided id by passing this id to the <b>delete()</b> method, who sends back a response.<br>
     * 
     * @param int $id The id of the requested TicketCategory
     * @return Jsend
     */
    public function destroy($id) {
        return Jsend::compile(self::delete($id));
    }

    /**
     * Remove a relationship between an existing TicketCategory and an existing Event, from the provided TicketCategory.
     *
     * If the TicketCategory provided is not proposed in an Event, a <b>Jsend::fail</b> is returned.<br>
     * If the delete was not completed, a <b>Jsend::error</b> is returned.<br>
     * Or else a <b>Jsend::success</b> is returned.<br>
     * 
     * @param TicketCategory $ticket category The TicketCategory that symbolizes an Event, whose association is to be deleted
     * @return array Contains an array with either a <b>fail</b>, <b>error</b> or <b>success</b> key and its corresponding message
     */
    public static function delete($id) {
        $object = Ticket::exist($id);
        if ($object == null) {
            $response = array(
                'fail' => array(
                    'ticket' => [trans('fail.ticket.inexistant')],
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
