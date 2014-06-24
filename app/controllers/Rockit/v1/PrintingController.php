<?php

namespace Rockit\v1;

use \Input,
    \Jsend,
    \Rockit\Printing,
	Rockit\Controllers\CompletePivotControllerTrait;

class PrintingController extends \BaseController {

	use CompletePivotControllerTrait;

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::only('nb_copies', 'nb_copies_surplus', 'event_id', 'printing_type_id');
		$response = Printing::validate($data, Printing::$create_rules);
        if ($response === true) {
            $response = self::save('Printing', $data);
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
		$data = Input::only('nb_copies', 'nb_copies_surplus');
		$response = Printing::validate($data, Printing::$update_rules);
        if ($response === true) {
            $response = self::modify('Printing', $id, $data);
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
		return Jsend::compile(self::delete('Printing', $id));
	}


}
