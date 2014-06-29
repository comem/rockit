<?php

namespace Rockit\v1;

use \Input,
    \Jsend,
    \Rockit\Representer,
    \Rockit\Controllers\ControllerBSUDTrait;

/**
 * Contains interaction methods to the Representer model in the database.<br>
 * Based on the Laravel's BaseController.<br>
 * Can : <b>index</b> all the Representers, <b>show</b>, <b>destroy</b> and <b>update</b> one Representer.<br>
 * Since Representers can be linked to an event, the <b>delete</b> is actually a <b>softDelete</b>.
 * 
 * @author Mathias Oberson <mathias.oberson@heig-vd.ch>
 */
class RepresenterController extends BaseController {

    use ControllerBSUDTrait;

    /**
     * Display a listing of the resource.
     * 
     * Each Representer is returned with its own information. 
     * 
     * @return Jsend
     */
    public function index() {
        return Jsend::success(['response' => Representer::all()]);
    }

    /**
     * Display the specified resource.
     * 
     * Return a Representer with all of its relationships.<br>
     * If the provided id does not point to an existing Representer, a <b>Jsend::fail</b> is returned.<br>
     *
     * @param int $id The id of the requested Representer
     * @return Jsend
     */
    public function show($id) {
        $model = Representer::with('events')->find($id);
        if (is_object($model)) {
            $response = Jsend::success($model);
        } else {
            $response = Jsend::fail(['representer' => [trans('fail.representer.inexistant')]]);
        }
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     * 
     * Get the adequate inputs from the client request and test that each of them pass the validation rules.<br>
     * If any a these inputs fails, a <b>Jsend::fail</b> is returned.<br>
     * If all the inputs are valid, the data is then passed to the <b>save()</b> method.<br>
     *
     * @return Jsend
     */
    public function store() {
        $data = Input::only('first_name', 'last_name', 'email', 'phone', 'street', 'npa', 'city', 'country');
        $response = Representer::validate($data, Representer::$create_rules);
        if ($response === true) {
            $response = self::save('Representer', $data);
        }
        return Jsend::compile($response);
    }

    /**
     * Update the specified resource in storage.
     * 
     * If the provided id does not point to an existing Representer, a <b>Jsend::fail</b> is returned.<br>
     * Get the adequate inputs from the client request and test that each of them pass the validation rules.<br>
     * If any a these inputs fail, a <b>Jsend::fail</b> is returned.<br>
     * If all the inputs are valid, the data is then passed to the <b>modify()</b> method.<br>
     *
     * @param int $id The id of the requested Representer
     * @return Jsend
     */
    public function update($id) {
        $data = Input::only('first_name', 'last_name', 'email', 'phone', 'street', 'npa', 'city', 'country');
        $response = Representer::validate($data, Representer::$update_rules);
        if ($response === true) {
            $response = self::modify('Representer', $id, $data);
        }
        return Jsend::compile($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * If the provided id does not point to an existing Representer, a <b>Jsend::fail</b> is returned.<br>
     * Or else this id is then passed to the <b>delete()</b> method that deletes the corresponding model.
     * 
     * @param int $id The id of the requested Representer
     * @return Jsend
     */
    public function destroy($id) {
        return Jsend::compile(self::delete('Representer', $id));
    }

}
