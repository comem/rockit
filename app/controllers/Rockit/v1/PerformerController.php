<?php

namespace Rockit\v1;

use \Input,
    \Jsend,
    \Rockit\Performer,
	Rockit\Controllers\CompletePivotControllerTrait;

class PerformerController extends \BaseController {

	use CompletePivotControllerTrait;


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::only('order', 'is_support', 'artist_hour_of_arrival', 'event_id', 'artist_id');
		$response = Performer::validate($data, Performer::$create_rules);
        if ($response === true) {
            $response = self::save('Performer', $data);
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
		$data = Input::only('order', 'is_support', 'artist_hour_of_arrival');
		$response = Performer::validate($data, Performer::$update_rules);
        if ($response === true) {
            $response = self::modify('Performer', $id, $data);
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
		return Jsend::compile(self::delete('Performer', $id));
	}


}
