<?php

namespace Rockit\v1;

use \Input,
    \Jsend,
    \Rockit\Need,
	Rockit\Controllers\CompletePivotControllerTrait;

class NeedController extends \BaseController {

	use CompletePivotControllerTrait;

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
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
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$data = Input::only('nb_people');
		$response = Need::validate($data, Need::$update_rules);
        if ($response === true) {
            $response = self::modify('Need', $id, $data);
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
		return Jsend::compile(self::delete('Need', $id));
	}


}
