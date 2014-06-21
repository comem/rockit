<?php

namespace Rockit\v1;

use \Input,
    \BaseController,
    \Jsend,
    Rockit\Representer;

class RepresenterController extends BaseController {
    
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $data = Input::only('first_name', 'last_name', 'email', 'phone', 'street', 'npa', 'city');
        $response = Representer::validate($data, Representer::$create_rules);
        if ($response === true) {
            $response = Representer::createOne($data);
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
        $object = Representer::exist($id);
        if ($object == null) {
            $response = array(
                'fail' => array(
                    'title' => trans('fail.representer.inexistant'),
                    'id' => (int) $id,
                ),
            );
        } else {
            $response = Representer::deleteOne($object);
        }
        return Jsend::compile($response);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return Representer::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $data = Input::only('first_name', 'last_name', 'email', 'phone', 'street', 'npa', 'city');
        $response = Representer::validate($data, Representer::$update_rules);
        if ($response === true) {
            $object = Representer::exist($id);
            if ($object == null) {
                $response = array(
                    'fail' => array(
                        'title' => trans('fail.representer.inexistant'),
                        'id' => (int) $id,
                    ),
                );
            } else {
                $response = Representer::updateOne($data, $object);
            }
        }
        return Jsend::compile($response);
    }

}
