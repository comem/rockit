<?php

namespace Rockit\v1;

use \Input,
    \Jsend,
    Rockit\Link;

class LinkController extends \BaseController {

    use \Rockit\Controllers\ControllerBSUDTrait;

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $data = Input::only('url', 'name_de', 'title_de', 'artist_id');
        $response = Link::validate($data, Link::$create_rules);
        if ($response === true) {
            $response = self::save('Link', $data);
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
        $new_data = Input::only('url', 'name_de', 'title_de');
        $response = Link::validate($data, Link::$update_rules);
        if($response === true) {
            $response = self::modify('Link', $id, $new_data);
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
        return Jsend::compile(self::delete('Link', $id));
    }

}
