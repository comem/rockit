<?php

namespace Rockit\v1;

use \Input,
    \Jsend,
    \Rockit\Offer,
	Rockit\Controllers\CompletePivotControllerTrait;

class OfferController extends \BaseController {

	use CompletePivotControllerTrait;

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::only('cost', 'quantity', 'comment_de', 'event_id', 'gift_id');
		$response = Offer::validate($data, Offer::$create_rules);
        if ($response === true) {
            $response = self::save('Offer', $data);
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
		$data = Input::only('cost', 'quantity', 'comment_de');
		$response = Offer::validate($data, Offer::$update_rules);
        if ($response === true) {
            $response = self::modify('Offer', $id, $data);
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
		return Jsend::compile(self::delete('Offer', $id));
	}


}
