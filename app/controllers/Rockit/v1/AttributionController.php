<?php

namespace Rockit\v1;

use \Input,
    \Jsend,
    \Rockit\Attribution,
    Rockit\Controllers\CompletePivotControllerTrait;

class AttributionController extends \BaseController {

    use CompletePivotControllerTrait;

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $data = Input::only('cost', 'quantity', 'event_id', 'equipment_id');
        $response = Attribution::validate($data, Attribution::$create_rules);
        if ($response === true) {
            $response = self::save('Attribution', $data);
        }
        return Jsend::compile($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $data = Input::only('cost', 'quantity');
        $response = Attribution::validate($data, Attribution::$update_rules);
        if ($response === true) {
            $response = self::modify('Attribution', $id, $data);
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
        return Jsend::compile(self::delete('Attribution', $id));
    }

}
