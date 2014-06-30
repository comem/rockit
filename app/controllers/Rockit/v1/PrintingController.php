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
     * TO DO
     *
     * @param  int  ?$id?
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
     * Destroy the association between a PrintingType and an Event that it is printed for.
     *
     * TO DO
     * 
     * 
     * @param int $id ?what id?
     * @return Jsend
     */
    public function destroy($id) {
        return Jsend::compile(self::delete('Printing', $id));
    }

    /**
     * Modify the Printing's informations on the database.
     * TO DO
     * blablabla...
     * If the Printing's source is successfully modified, the file referenced by the old source value is deleted.
     * blablabla...
     * remember to add to ControllerComments at the top.
     * 
     * @param type $id
     * @param type $new_data
     * @return type
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
