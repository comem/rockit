<?php

namespace Rockit\v1;

use \Input,
    \Jsend,
    \Rockit\EventType,
    \Rockit\Controllers\ControllerBSRDTrait;

class EventTypeController extends \BaseController {

    use ControllerBSRDTrait;

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return Jsend::success(EventType::all());
	}

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $data = Input::only('name_de');
        $response = self::renew('EventType', $data);
        if ($response === false) {
            $response = EventType::validate($data, EventType::$create_rules);
            if ($response === true) {
                $response = self::save('EventType', $data, TRUE, 'name_de');
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
        return Jsend::compile(self::delete('EventType', $id));
    }


}
