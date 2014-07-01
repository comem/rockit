<?php

namespace Rockit\v1;

use \Input,
    \Jsend,
    \Rockit\Staff,
    Rockit\Controllers\CompletePivotControllerTrait;

/**
 * A Staff links a Member to a Skill that he executes.
 * Contains interaction methods to the Staff model in the database.<br>
 * Based on the Laravel's BaseController.<br>
 * Can : <b>store</b>, <b>update</b> and <b>destroy</b> a Staff.<br>
 * 
 * @author Joël Gugger <joel.gugger@heig-vd.ch>
 */
class StaffController extends \BaseController {

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
        $data = Input::only('member_id', 'skill_id', 'event_id');
        $response = Staff::validate($data, Staff::$create_rules);
        if ($response === true) {
            $response = self::save($data);
        }
        return Jsend::compile($response);
    }

    /**
     * Update the specified resource in storage.
     * 
     * If the provided id does not point to an existing Staff, a <b>Jsend::fail</b> is returned.<br>
     * Get the adequate inputs from the client request and test that each of them pass the validation rules.<br>
     * If any a these inputs fail, a <b>Jsend::fail</b> is returned.<br>
     * If all the inputs are valid, the data is then passed to the <b>modify()</b> method.<br>
     *
     * @param int $id The id of the requested Staff
     * @return Jsend
     */
    public function update($id) {
        $data = Input::only('skill_id');
        $response = Staff::validate($data, Staff::$update_rules);
        if ($response === true) {
            $response = self::modify($id, $data);
        }
        return Jsend::compile($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * If the provided id does not point to an existing Staff, a <b>Jsend::fail</b> is returned.<br>
     * Or else this id is then passed to the <b>delete()</b> method that deletes the corresponding model.
     * 
     * @param int $id The id of the requested Staff
     * @return Jsend
     */
    public function destroy($id) {
        return Jsend::compile(self::delete('Staff', $id));
    }

    /**
     * Save a new Staff in the database with the given inputs, that include a member id, a skill id and an event id.
     * 
     * If the provided Member and Skill combination already exists for this Event, a <b>Jsend::fail</b> is returned.<br>
     * If the provided Member does not have the competence to fulfill this Skill, a <b>Jsend::fail</b> is returned.<br>
     * If the provided Skill is not needed for this Event, a <b>Jsend::fail</b> is returned.<br>
     * Or else, the data is passed to the <b>createOne()</b> method of the Staff model.<br>
     * 
     * @param array $inputs
     * @return Jsend
     */
    public static function save(array $data) {
        $object = Staff::existByIds($data);
        if (is_object($object)) {
            $response = array('fail' => ['staff' => [trans('fail.staff.existing')]]);
        } else {
            $response = Staff::checkMemberFulfillment($data['member_id'], $data['skill_id']);
            if ($response === true) {
                $response = Staff::checkEventNeed($data['event_id'], $data['skill_id']);
                if ($response === true) {
                    $response = Staff::createOne($data);
                }
            }
        }
        return $response;
    }

    /**
     * Modify the Staff's informations on the database.
     * TO DO
     * blablabla...
     * remember to add to ControllerComments at the top.
     * 
     * @param type $id
     * @param type $new_data
     * @return type
     */
    public static function modify($id, $data) {
        $object = Staff::exist($id);
        if ($object == null) {
            $response = [
                'fail' => [
                    'title' => trans('fail.event.inexistant'),
                ],
            ];
        } else {
            $response = Staff::checkMemberFulfillment($object->member_id, $object->skill_id);
            if ($response === true) {
                $response = Staff::checkEventNeed($object->event_id, $object->skill_id);
                if ($response === true) {
                    $response = Staff::updateOne($data, $object);
                }
            }
        }
        return $response;
    }

    public static function saveAsAssociation( array $data ){
        return self::save( $data );
    }

}
