<?php

namespace Rockit\Controllers\v1;

use \Input,
    Rockit\Helpers\Jsend,
    \Rockit\Models\Performer,
    \Rockit\Traits\Controllers\CompletePivotControllerTrait;

/**
 * Contains interaction methods to the Performer model in the database.<br>
 * A Performer links an Artist to an Event that he performs at.
 * Based on the Laravel's BaseController.<br>
 * Can : <b>store</b>, <b>update</b> and <b>destroy</b> a Performer.<br>
 * 
 * @author Joël Gugger <joel.gugger@heig-vd.ch>
 */
class PerformerController extends \BaseController {

    use CompletePivotControllerTrait;

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
        $data = Input::only('order', 'is_support', 'artist_hour_of_arrival', 'event_id', 'artist_id');
        $response = Performer::validate($data, Performer::$create_rules);
        if ($response === true) {
            $response = self::save($data);
        }
        return Jsend::compile($response);
    }

    /**
     * Update the association between an Event and a Performer that corresponds to the provided performer id, with the provided inputs.
     *
     * Get the adequate inputs from the client request and test that each of them pass the update validation rules.<br>
     * Modifies the Performer that matches the provided id by passing this id to the <b>modify()</b> method, who sends back a response.<br>
     * 
     * @param int $id The id of the requested Performer
     * @return Jsend
     */
    public function update($id) {
        $data = Input::only('order', 'is_support', 'artist_hour_of_arrival');
        $response = Performer::validate($data, Performer::$update_rules);
        if ($response === true) {
            $response = self::modify($id, $data);
        }
        return Jsend::compile($response);
    }

    /**
     * Destroy the association between an Event and an Artist that performs in that Event, corresponding to the provided performer id.
     *
     * Destroys the Performer that matches the provided id by passing this id to the <b>delete()</b> method, who sends back a response.<br>
     * 
     * @param int $id The id of the requested Performer
     * @return Jsend
     */
    public function destroy($id) {
        return Jsend::compile(self::delete('Performer', $id));
    }

    public static function save(array $data) {
        $object = Performer::existByIds($data);
        if (is_object($object)) {
            $response['fail'] = ['performer' => [trans('fail.performer.existing')]];
        }
        if (!isset($response)) {
            Performer::getOrderAvailable($data);
            $response = Performer::createOne($data);
        }
        return $response;
    }

    /**
     * Modify an existing Performer, from the provided performer id and the data to update to.
     * 
     * If the provided performer id does not point to an existing Performer, a <b>Jsend::fail</b> is returned.<br>
     * If an 'order' is already in use, that 'order' value is incremented till a number that is not in use is reached.<br>
     * Then the provided Performer and the new data to update to are passed to the <b>updateOne</b> method of the Performer model, which returns a response.<br>
     *
     * @param id $id The id of the Performer to modify
     * @param array $new_data The data to update to for the specified Performer
     * @return Jsend
     */
    public static function modify($id, $new_data) {
        $object = Performer::exist($id);
        if ($object == null) {
            $response['fail'] = ['perfomer' => [trans('fail.performer.inexistant')]];
        } else {
            Performer::getOrderAvailable($new_data, $object);
            $response = Performer::updateOne($new_data, $object);
        }
        return $response;
    }

    /**
     * Save a new Performer as an association between an Event and an Artist from the provided inputs.
     * 
     * @param array $data The data to save in the specified Performer 
     * @return Jsend
     */
    public static function saveAsAssociation( array $data ){
        return self::save( $data );
    }

}
