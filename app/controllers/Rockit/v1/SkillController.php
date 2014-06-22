<?php

namespace Rockit\v1;

use \Input,
    \Jsend,
    \Rockit\Skill,
    \Rockit\FunctionnalServicesTrait;

class SkillController extends \BaseController {

    use FunctionnalServicesTrait;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $models = Skill::all();
        if (is_object($models)) {
            $response = Jsend::success($models);
        } else {
            $response = Jsend::fail('fail.skill.none');
        }
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $data = Input::only('name_de');
        $response = self::renew('Skill', $data);
        if ($response !== false) {
            $response = array('success' => trans('success.skill.restored'));
        } else {
            $response = self::save('Skill', $data, true, 'name_de');
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
        return Jsend::compile(self::delete('Skill', $id));
    }

}
