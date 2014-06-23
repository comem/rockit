<?php

namespace Rockit\v1;

use \Input,
    Rockit\Description;

class DescriptionController extends \BaseController {

    use \Rockit\Controllers\SimplePivotControllerTrait;

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $data = Input::only('artist_id', 'genre_id');
        $response = Description::validate($data, Description::$rules);
        if ($response === true) {
            $response = self::save('Description', $data);
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
