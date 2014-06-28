<?php

namespace Rockit\v1;

use \Input,
    \Jsend,
    \Route,
    \Request,
    \Rockit\Printing,
    Rockit\Controllers\CompletePivotControllerTrait;

class PrintingController extends \BaseController {

    use CompletePivotControllerTrait;

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
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
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        return Jsend::compile(self::delete('Printing', $id));
    }

    /**
     * Modify the Printing's informations on the database.
     * 
     * blablabla...
     * If the Printing's source is successfully modified, the file referenced by the old source value is deleted.
     * blablabla...
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
