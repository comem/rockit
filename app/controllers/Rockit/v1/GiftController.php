<?php

namespace Rockit\v1;

use \Input,
    \Jsend,
    \Rockit\Gift,
    \Rockit\Controllers\ControllerBSRDTrait;

class GiftController extends \BaseController {

    use ControllerBSRDTrait;
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return Jsend::success(Gift::all()->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $data = Input::only('name_de');
        $response = self::renew('Gift', $data);

        if ($response === false) {
            $response = Gift::validate($data, Gift::$create_rules);
            if ($response === true) {
                $response = self::save('Gift', $data, TRUE, 'name_de');
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
        return Jsend::compile(self::delete('Gift', $id));
    }

}
