<?php

namespace Rockit\v1;

use \Input,
    \Jsend,
    \Rockit\Attribution,
    Rockit\Controllers\CompletePivotControllerTrait;

/**
 * Contains interaction methods to the Attribution model in the database.<br>
 * Based on the Laravel's BaseController.<br>
 * Can : <b>store</b>, <b>update</b> and <b>destroy</b> one Attribution<br>
 * An Attribution is the link between an Event and an Equipment that is reserved for that Event.<br>
 * 
 * @author Joël Gugger <joel.gugger@heig-vd.ch>
 */
class AttributionController extends \BaseController {

    use CompletePivotControllerTrait;

    /**
     * Store a new association between an Event and an Equipment that is attributed for that Event.
     * 
     * Get the adequate inputs from the client request and test that each of them pass the validation rules.<br>
     * If any of these inputs fails, a <b>Jsend::fail</b> is returned.<br>
     * If all the inputs are valid, the data is then passed to the <b>save()</b> method, who sends back a response.<br>
     *
     * @return Jsend
     */
    public function store() {
        $data = Input::only('cost', 'quantity', 'event_id', 'equipment_id');
        $response = Attribution::validate($data, Attribution::$create_rules);
        if ($response === true) {
            $response = self::save('Attribution', $data);
        }
        return Jsend::compile($response);
    }

    /**
     * Update the specified resource in storage.
     * 
     * TO DO
     *
     * @param int $id ?What id?
     * @return Jsend
     */
    public function update($id) {
        $data = Input::only('cost', 'quantity');
        $response = Attribution::validate($data, Attribution::$update_rules);
        if ($response === true) {
            $response = self::modify('Attribution', $id, $data);
        }
        return Jsend::compile($response);
    }

    /**
     * Destroys the association between an Event and an Equipment, from the provided .
     *
     * TO DO
     * 
     * @param int $id ?what id?
     * @return Jsend
     */
    public function destroy($id) {
        return Jsend::compile(self::delete('Attribution', $id));
    }

    public static function saveAsAssociation( array $data ){
        return self::save( 'Attribution', $data );
    }

}
