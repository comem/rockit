<?php

namespace Rockit\v1;

use \Input,
    \Jsend,
    Rockit\TicketCategory,
    \Rockit\Controllers\ControllerBSRDTrait;

class TicketCategoryController extends \BaseController {

    use ControllerBSRDTrait;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return Jsend::success(TicketCategory::all()->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $data = Input::only('name_de');
        $response = self::renew('TicketCategory', $data);
        if ($response === false) {
            $response = TicketCategory::validate($data, TicketCategory::$create_rules);
            if ($response === true) {
                $response = self::save('TicketCategory', $data, TRUE, 'name_de');
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
        return Jsend::compile(self::delete('TicketCategory', $id));
    }

}
