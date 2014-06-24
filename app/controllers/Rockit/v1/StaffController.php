<?php

namespace Rockit\v1;

use \Input,
    \Jsend,
    \Rockit\Staff,
	Rockit\Controllers\SimplePivotControllerTrait;

class StaffController extends \BaseController {

	use SimplePivotControllerTrait;


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
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


	public static function save(array $data) {
        $object = Staff::exist($data);
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


}
