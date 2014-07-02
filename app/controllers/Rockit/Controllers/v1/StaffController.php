<?php

namespace Rockit\Controllers\v1;

use \Input,
    Rockit\Helpers\Jsend,
    \Rockit\Models\Staff,
    \Rockit\Traits\Controllers\CompletePivotControllerTrait;

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
     * Update the association between an Event, a Member and a Skill that corresponds to the provided staff id, with the provided inputs.
     *
     * Get the adequate inputs from the client request and test that each of them pass the update validation rules.<br>
     * Modifies the Staff that matches the provided id by passing this id to the <b>modify()</b> method, who sends back a response.<br>
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
     * Modify an existing association between a Member and a Skill that he executes, from the provided staff id and the data to update to.
     * 
     * If the provided staff id does not point to an existing Staff, a <b>Jsend::fail</b> is returned.<br>
     * The member id, skill id and event id provided will be used to verify the validity of the update <b>before</b> modifying the Staff.<br> 
     * If the Member provided cannot fulfill the provided Skill, a <b>Jsend::fail</b> is returned.<br> 
     * If the provided Skill is not needed in the provided Event, a <b>Jsend::fail</b> is returned.<br>
     * Or else, the Staff to modify and the data to update to is passed to the <b>updateOne</b> method.<br>
     * 
     * @param id $id The id of the Staff to modify
     * @param array $new_data The data to update in the specified Staff 
     * @return Jsend
     */
    public static function modify($id, $data) {
        $object = Staff::exist($id);
        if ($object == null) {
            $response = [
                'fail' => [
                    'title' => trans('fail.staff.inexistant'),
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

    /**
     * Save a new Staff as an association between an Event and a Member from the provided inputs.
     * 
     * @param array $data The data to save in the specified Staff 
     * @return Jsend
     */
    public static function saveAsAssociation( array $data ){
        return self::save( $data );
    }

}
