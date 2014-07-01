<?php

namespace Rockit\v1;

use \Input,
    \Jsend,
    \Rockit\Performer,
    \Rockit\Controllers\CompletePivotControllerTrait;

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
     * Update the specified resource in storage.
     * 
     * If the provided id does not point to an existing Performer, a <b>Jsend::fail</b> is returned.<br>
     * Get the adequate inputs from the client request and test that each of them pass the validation rules.<br>
     * If any a these inputs fail, a <b>Jsend::fail</b> is returned.<br>
     * If all the inputs are valid, the data is then passed to the <b>modify()</b> method.<br>
     * TO REVIEW
     *
     * @param int $id The id of ?who?
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
     * Remove the specified resource from storage.
     *
     * If the provided id does not point to an existing Performer, a <b>Jsend::fail</b> is returned.<br>
     * Or else this id is then passed to the <b>delete()</b> method that deletes the corresponding model.
     * TO REVIEW
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

    public static function saveAsAssociation( array $data ){
        return self::save( $data );
    }

}
