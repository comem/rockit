<?php

namespace Rockit\v1;

use \Input,
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
        $response = self::save('Link', $data, true, 'url');
        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
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
