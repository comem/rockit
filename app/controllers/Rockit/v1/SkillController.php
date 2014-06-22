<?php

namespace Rockit\v1;

use \Rockit\FunctionnalServicesTrait,
    \Input,
    \Jsend;

class SkillController extends \BaseController {

    use FunctionnalServicesTrait;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $data = Input::only('name_de');
        $response = self::save('Skill', $data, true, $data['name_de']);
        return Jsend::compile($response);
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
