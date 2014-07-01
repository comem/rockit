<?php

namespace Rockit\v1;

use \Input,
    \Jsend,
    \Rockit\Offer,
    Rockit\Controllers\CompletePivotControllerTrait;

/**
 * An Offer is the link between a Gift and an Event that it is offered in.<br>
 * Contains interaction methods for the relationship between an Event and a Gift.<br>
 * Based on the Laravel's BaseController.<br>
 * Can : <b>store</b>, <b>update</b> and <b>destroy</b> an association between a Gift and an Event.<br>
 * 
 * @author Joël Gugger <joel.gugger@heig-vd.ch>
 */
class OfferController extends \BaseController {

    use CompletePivotControllerTrait;

    /**
     * Store a new association between a Gift and an Event that it is offered in.
     * 
     * Get the adequate inputs from the client request and test that each of them pass the validation rules.<br>
     * If any of these inputs fails, a <b>Jsend::fail</b> is returned.<br>
     * If all the inputs are valid, the data is then passed to the <b>save()</b> method, who sends back a response.<br>
     *
     * @return Jsend
     */
    public function store() {
        $data = Input::only('cost', 'quantity', 'comment_de', 'event_id', 'gift_id');
        $response = Offer::validate($data, Offer::$create_rules);
        if ($response === true) {
            $response = self::save('Offer', $data);
        }
        return Jsend::compile($response);
    }

    /**
     * Update the association between an Event and an offered Gift that corresponds to the provided offer id, with the provided inputs.
     *
     * Get the adequate inputs from the client request and test that each of them pass the update validation rules.<br>
     * Modifies the Offer that matches the provided id by passing this id to the <b>modify()</b> method, who sends back a response.<br>
     * 
     * @param int $id The id of the requested Offer
     * @return Jsend
     */
    public function update($id) {
        $data = Input::only('cost', 'quantity', 'comment_de');
        $response = Offer::validate($data, Offer::$update_rules);
        if ($response === true) {
            $response = self::modify('Offer', $id, $data);
        }
        return Jsend::compile($response);
    }

    /**
     * Destroy the association between a Gift and an Event that offers that Gift, corresponding to the provided offer id.
     *
     * Destroys the Offer that matches the provided id by passing this id to the <b>delete()</b> method, who sends back a response.<br>
     * 
     * @param int $id The id of the requested Offer
     * @return Jsend
     */
    public function destroy($id) {
        return Jsend::compile(self::delete('Offer', $id));
    }

}
