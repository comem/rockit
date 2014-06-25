<?php

namespace Rockit\v1;

use \Input,
    \Jsend,
    Rockit\PrintingType,
    \Rockit\Controllers\ControllerBSRDTrait;

class PrintingTypeController extends \BaseController {
    
    use ControllerBSRDTrait;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return Jsend::success(PrintingType::all()->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $data = Input::only('name_de');
        $response = self::renew('PrintingType', $data);
        if ($response === false) {
            $response = PrintingType::validate($data, PrintingType::$create_rules);
            if ($response === true) {
                $response = self::save('PrintingType', $data, TRUE, 'name_de');
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
        return Jsend::compile(self::delete('PrintingType', $id));
    }

}
