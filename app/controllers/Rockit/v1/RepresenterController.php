<?php

namespace Rockit\v1;

use \Input,
    \BaseController,
    \Jsend,
    \Rockit\Representer,
    \Rockit\FunctionnalServicesTrait;

class RepresenterController extends BaseController {

    use FunctionnalServicesTrait;

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $data = Input::only('first_name', 'last_name', 'email', 'phone', 'street', 'npa', 'city');
        $response = Representer::validate($data, Representer::$create_rules);
        if ($response === true) {
            $response = self::save('Representer', $data);
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
        return Jsend::compile(self::delete('Representer', $id));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $models = Representer::all();
        if (is_object($models)) {
            $response = Jsend::success($models);
        } else {
            $response = Jsend::fail(trans('fail.representer.none'));
        }
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $model = Representer::find($id);
        if (is_object($model)) {
            $response = Jsend::success($model->toArray());
        } else {
            $response = Jsend::fail(trans('fail.representer.inexistant'));
        }
        return $response;
    }

    /**
     * Update the specified Model in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $data = Input::only('first_name', 'last_name', 'email', 'phone', 'street', 'npa', 'city');
        $response = Representer::validate($data, Representer::$update_rules);
        if ($response === true) {
            $response = self::modify('Representer', $id, $data);
        }
        return Jsend::compile($response);
    }

}
