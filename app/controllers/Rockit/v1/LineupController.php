<?php

namespace Rockit\v1;

use \Input,
    \Jsend,
    \Rockit\Lineup,
    Rockit\Controllers\SimplePivotControllerTrait;

class LineupController extends \BaseController {

    use SimplePivotControllerTrait;

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $data = Input::only('musician_id', 'instrument_id', 'artist_id');
        $response = Lineup::validate($data, Lineup::$create_rules);
        if ($response === true) {
            $response = self::save('Lineup', $data);
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
        return Jsend::compile(self::delete('Lineup', $id));
    }

}
