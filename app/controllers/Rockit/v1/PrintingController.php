<?php

namespace Rockit\v1;

use \Input,
    \Jsend,
    \Route,
    \Request,
    \Rockit\Printing,
    Rockit\Controllers\CompletePivotControllerTrait;

/**
 * A Printing is the link between a PrintingType and an Event that it is printed for.<br>
 * Contains interaction methods for the relationship between an Event and a PrintingType.<br>
 * Based on the Laravel's BaseController.<br>
 * Can : <b>store</b>, <b>update</b> and <b>destroy</b> an association between a Gift and an Event.<br>
 * 
 * @author Joël Gugger <joel.gugger@heig-vd.ch>
 */
class PrintingController extends \BaseController {

    use CompletePivotControllerTrait;

    /**
     * Store a new association between a PrintingType and an Event that it is printed for.
     * 
     * Get the adequate inputs from the client request and test that each of them pass the validation rules.<br>
     * If any of these inputs fails, a <b>Jsend::fail</b> is returned.<br>
     * If all the inputs are valid, the data is then passed to the <b>save()</b> method, who sends back a response.<br>
     *
     * @return Jsend
     */
    public function store() {
        $data = Input::only('nb_copies', 'nb_copies_surplus', 'event_id', 'printing_type_id', 'source');
        $response = Printing::validate($data, Printing::$create_rules);
        if ($response === true) {
            $response = self::save('Printing', $data);
        }
        return Jsend::compile($response);
    }

    /**
     * Update the association between an Event and a PrintingType that corresponds to the provided printing id, with the provided inputs.
     *
     * Get the adequate inputs from the client request and test that each of them pass the update validation rules.<br>
     * Modifies the Printing that matches the provided id by passing this id to the <b>modify()</b> method, who sends back a response.<br>
     * 
     * @param int $id The id of the requested Printing
     * @return Jsend
     */
    public function update($id) {
        $data = Input::only('nb_copies', 'nb_copies_surplus', 'source');
        $response = Printing::validate($data, Printing::$update_rules);
        if ($response === true) {
            $response = self::modify($id, $data);
        }
        return Jsend::compile($response);
    }

    /**
     * Destroy the association between a PrintingType and an Event that it is printed for, corresponding to the provided printing id.
     *
     * Destroys the Printing that matches the provided id by passing this id to the <b>delete()</b> method, who sends back a response.<br>
     * 
     * @param int $id The id of the requested Printing
     * @return Jsend
     */
    public function destroy($id) {
        return Jsend::compile(self::delete('Printing', $id));
    }

    /**
     * Modify an existing association between a PrintingType and an Event that it is printed for, from the provided printing id and the data to update to.
     * 
     * This method renames the source file.<br>
     * If the provided printing id does not point to an existing Printing, a <b>Jsend::fail</b> is returned.<br>
     * Or else, the Printing to modify and the data to update to is passed to the <b>updateOne</b> method.<br>
     * If the Printing's source file name is successfully modified, a <b>Jsend::success</b> is returned, and the file referenced by the old source value is deleted.<br>
     * 
     * @param id $id The id of the Printing to modify
     * @param array $new_data The data to update in the specified Printing 
     * @return Jsend
     */
    public function modify($id, $new_data) {
        $object = Printing::exist($id);
        if ($object == null) {
            $response['fail'] = ['printing' => [trans('fail.printing.inexistant')]];
        } else {
            // Get the old source
            $path = explode('/', $object->source);
            // Create an url to delete the old source
            $url = 'v1/files/' . $path[0] . '/' . $path[1];
            $response = Printing::updateOne($new_data, $object);
            if (isset($response['success'])) {
                // Delete the old source if the update is a success
                $request = Request::create($url, 'DELETE');
                Route::dispatch($request);
            }
        }
        return $response;
    }

}
