<?php

namespace Rockit\v1;

use \Input,
    \Jsend,
    \Rockit\Genre,
    \Rockit\Controllers\ControllerBSRDTrait;

class GenreController extends \BaseController {

    use ControllerBSRDTrait;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return Jsend::success(Genre::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $data = Input::only('name_de');
        $response = self::renew('Genre', $data);
        if ($response === false) {
            $response = Genre::validate($data, Genre::$create_rules);
            if ($response === true) {
                $response = self::save('Genre', $data, TRUE, 'name_de');
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
        return Jsend::compile(self::delete('Genre', $id));
    }

}
