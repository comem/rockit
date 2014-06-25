<?php

namespace Rockit\v1;

use Rockit\Instrument;
use \App,
    \Lang,
    \Input,
    \Auth,
    \Jsend;

class InstrumentController extends \BaseController {

    use \Rockit\Controllers\ControllerBSRDTrait;
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return \Jsend::success(\Rockit\Instrument::all()->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $data = \Input::only('name_de');
        $response = self::renew('Instrument', $data);
        if ($response === false) {
            $response = \Rockit\Instrument::validate($data, \Rockit\Instrument::$create_rules);
            if ($response === true) {
                $response = self::save('Instrument', $data, TRUE, 'name_de');
            }
        }
        return \Jsend::compile($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        return \Jsend::compile(self::delete('Instrument', $id));
    }

}
