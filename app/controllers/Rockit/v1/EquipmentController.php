<?php

namespace Rockit\v1;

use \Input,
    \Jsend,
    \Rockit\Equipment,
    \Rockit\Controllers\ControllerBSRDTrait;

class EquipmentController extends \BaseController {

    use ControllerBSRDTrait;

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $data = Input::only('name_de');
        $response = self::renew('Equipment', $data);
        if ($response === false) {
            $response = Equipment::validate($data, Equipment::$create_rules);
            if ($response === true) {
                $response = self::save('Equipment', $data, TRUE, 'name_de');
            }
        }
        return Jsend::compile($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        return Jsend::compile(self::delete('Equipment', $id));
    }


}
