<?php

namespace Rockit\v1;

use \Input,
    \Jsend,
    \Rockit\Staff,
	Rockit\Controllers\CompletePivotControllerTrait;

class StaffController extends \BaseController {

	use CompletePivotControllerTrait;


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
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
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
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
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		return Jsend::compile(self::delete('Staff', $id));
	}


	public static function save(array $data) {
        $object = Staff::existByIds($data);
        if (is_object($object)) {
            $response = array('fail' => trans('fail.staff.existing'));
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

    public static function modify($id, $data) {
        $object = Staff::exist($id);
        if ($object == null) {
            $response = array(
                'fail' => array(
                    'title' => trans('fail.staff.inexistant'),
                ),
            );
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


}
