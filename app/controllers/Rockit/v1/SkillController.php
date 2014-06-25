<?php

namespace Rockit\v1;

use \Input,
    \Jsend,
    \Rockit\Skill,
    \Rockit\Controllers\ControllerBSRDTrait;

class SkillController extends \BaseController {

    use ControllerBSRDTrait;

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return Jsend::success(Skill::all());
	}

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $data = Input::only('name_de');
        $response = self::renew('Skill', $data);
        if ($response === false) {
            $response = Skill::validate($data, Skill::$create_rules);
            if ($response === true) {
                $response = self::save('Skill', $data, TRUE, 'name_de');
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
        return Jsend::compile(self::delete('Skill', $id));
    }


}
