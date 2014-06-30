<?php

namespace Rockit\v1;

use Rockit\Instrument;
use \Input,
    \Jsend;

/**
 * Contains interaction methods to the Instrument model in the database.<br>
 * Based on the Laravel's BaseController.<br>
 * Can : <b>index</b> all the Instruments, <b>store</b> and <b>destroy</b> one Instrument.<br>
 * Since Instruments can be linked to an event, the <b>delete</b> is actually a <b>softDelete</b>.
 * 
 * @author Christopher de Guzman <christopher.deguzman@heig-vd.ch>
 */
class InstrumentController extends \BaseController {

    use \Rockit\Controllers\ControllerBSRDTrait;

    /**
     * Display a listing of the resource.
     * 
     * Each Instrument is returned with its own information. 
     * 
     * @return Jsend
     */
    public function index() {
        return Jsend::success(['response' => Instrument::all()]);
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
        $data = Input::only('name_de');
        $response = self::renew('Instrument', $data);
        if ($response === false) {
            $response = Instrument::validate($data, Instrument::$create_rules);
            if ($response === true) {
                $response = self::save('Instrument', $data, TRUE, 'name_de');
            }
        }
        return Jsend::compile($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * If the provided id does not point to an existing Instrument, a <b>Jsend::fail</b> is returned.<br>
     * Or else this id is then passed to the <b>delete()</b> method that deletes the corresponding model.
     * 
     * @param int $id The id of the requested Instrument
     * @return Jsend
     */
    public function destroy($id) {
        return Jsend::compile(self::delete('Instrument', $id));
    }

}
