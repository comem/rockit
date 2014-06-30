<?php

namespace Rockit\v1;

use \Input,
    \Jsend,
    \Rockit\Need,
    Rockit\Controllers\CompletePivotControllerTrait;

/**
 * A Need links an Event to the Skills needed for that Event.
 * Contains interaction methods to the Need model in the database.<br>
 * Based on the Laravel's BaseController.<br>
 * Can : <b>store</b>, <b>update</b> and <b>destroy</b> a Need.<br>
 * 
 * @author Joël Gugger <joel.gugger@heig-vd.ch>
 */
class NeedController extends \BaseController {

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
        $data = Input::only('nb_people', 'event_id', 'skill_id');
        $response = Need::validate($data, Need::$create_rules);
        if ($response === true) {
            $response = self::save('Need', $data);
        }
        return Jsend::compile($response);
    }

    /**
     * Update the specified resource in storage.
     * 
     * //?If the provided id does not point to an existing Need, a <b>Jsend::fail</b> is returned.<br>
     * Get the adequate inputs from the client request and test that each of them pass the validation rules.<br>
     * If any a these inputs fail, a <b>Jsend::fail</b> is returned.<br>
     * If all the inputs are valid, the data is then passed to the <b>modify()</b> method.<br>
     *
     * @param int $id The id of the requested Need
     * @return Jsend
     */
    public function update($id) {
        $data = Input::only('nb_people');
        $response = Need::validate($data, Need::$update_rules);
        if ($response === true) {
            $response = self::modify('Need', $id, $data);
        }
        return Jsend::compile($response);
    }

    /**
     * Remove the specified resource from the database.
     *
     * //?If the provided id does not point to an existing Need, a <b>Jsend::fail</b> is returned.<br>
     * TO REVIEW
     * 
     * @param int $id The id of the Need to delete
     * @return array Contains an array with either a <b>fail</b>, <b>error</b> or <b>success</b> key and its corresponding message
     */
    public function destroy($id) {
        return Jsend::compile(self::delete('Need', $id));
    }

}
