<?php

namespace Rockit\Controllers\v1;

use \Input,
    Rockit\Helpers\Jsend,
    \Rockit\Models\Fulfillment,
    \Rockit\Traits\Controllers\SimplePivotControllerTrait;

/**
 * Contains interaction methods to the Fulfillment model in the database.<br>
 * A Fulfillment links a Skill to a Member that fulfills that Skill.
 * Based on the Laravel's BaseController.<br>
 * Can : <b>store</b> and <b>destroy</b> a Fulfillment.<br>
 * 
 * @author Joël Gugger <joel.gugger@heig-vd.ch>
 */
class FulfillmentController extends \BaseController {

    use SimplePivotControllerTrait;

    /**
     * Store a newly created resource in storage.
     * 
     * Get the adequate inputs from the client request and test that each of them pass the validation rules.<br>
     * If any a these inputs fails, a <b>Jsend::fail</b> is returned.<br>
     * If all the inputs are valid, the data is then passed to the <b>save()</b> method.<br>
     *
     * @return Jsend
     */
    public function store() {
        $data = Input::only('member_id', 'skill_id');
        $response = Fulfillment::validate($data, Fulfillment::$create_rules);
        if ($response === true) {
            $response = self::save('Fulfillment', $data);
        }
        return Jsend::compile($response);
    }

    /**
     * Destroys the association between a Member and a Skill that he fulfills, corresponding to the provided fulfillment id.
     *
     * If the provided id does not point to an existing Fulfillment, a <b>Jsend::fail</b> is returned.<br>
     * Or else this id is then passed to the <b>delete()</b> method, who sends back a response..
     * 
     * @param int $id The id of the requested Fulfillment
     * @return Jsend
     */
    public function destroy($id) {
        return Jsend::compile(self::delete('Fulfillment', $id));
    }

}
