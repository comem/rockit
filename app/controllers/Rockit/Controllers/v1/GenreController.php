<?php

namespace Rockit\Controllers\v1;

use \Input,
    \Jsend,
    \Rockit\Models\Genre,
    \Rockit\Traits\Controllers\ControllerBSRDTrait;

/**
 * Contains interaction methods to the Genre model in the database.<br>
 * Based on the Laravel's BaseController.<br>
 * Can : <b>index</b> all the Genres, <b>store</b> and <b>destroy</b> one Genre.<br>
 * Since Genres can be linked to an event, the <b>delete</b> is actually a <b>softDelete</b>.
 * 
 * @author Christopher de Guzman <christopher.deguzman@heig-vd.ch>
 */
class GenreController extends \BaseController {

    use ControllerBSRDTrait;

    /**
     * Display a listing of the resource.
     * 
     * Each Genre is returned with its own information. 
     * 
     * @return Jsend
     */
    public function index() {
        return Jsend::success(['response' => Genre::all()]);
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
        $response = self::renew('Genre', $data);
        if ($response === false) {
            $response = Genre::validate($data, Genre::$create_rules);
            if ($response === true) {
                $response = self::save('Genre', $data, TRUE, 'name_de');
            }
        }
        return Jsend::compile($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * If the provided id does not point to an existing Genre, a <b>Jsend::fail</b> is returned.<br>
     * Or else this id is then passed to the <b>delete()</b> method that deletes the corresponding model.
     * 
     * @param int $id The id of the requested Genre
     * @return Jsend
     */
    public function destroy($id) {
        return Jsend::compile(self::delete('Genre', $id));
    }

}
