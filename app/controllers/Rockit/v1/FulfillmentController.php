<?php

namespace Rockit\v1;
use \Input,
    \Jsend,
    \Rockit\Fulfillment,
	Rockit\Controllers\SimplePivotControllerTrait;

class FulfillmentController extends \BaseController {

	use SimplePivotControllerTrait;

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::only('member_id', 'skill_id');
		$response = Fulfillment::validate($data, Fulfillment::$create_rules);
        if ($response === true) {
            $response = self::save('Fulfillment', $data);
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
		return Jsend::compile(self::delete('Fulfillment', $id));
	}


}
