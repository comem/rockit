<?php

namespace Rockit\v1;

use \Rockit\Artist,
    \Rockit\Genre,
    \Rockit\Controllers\ControllerBSUDTrait,
    \Jsend,
    \Input;

class ArtistController extends \BaseController {

    use ControllerBSUDTrait;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //
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
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $inputs = Input::only('name', 'short_description_de', 'complete_description_de', 'genres');
        $validate = Artist::validate($inputs, Artist::$create_rules);
        if ($validate === true) {
            $response = self::save($inputs, $genres['genres']);
        } else {
            $response = $validate;
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
        $new_data = Input::only('name', 'short_description_de', 'complete_description_de');
        $validate = Artist::validate($inputs, Artist::$update_rules);
        if ($validate === true) {
            $response = self::modify('Artist', $id, $new_data);
        } else {
            $response = $validate;
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
        return Jsend::compile(self::delete('Artist', $id));
    }

    public static function save($inputs, $genres) {
        $mergedGenres = array_unique($genres);
        foreach ($mergedGenres as $genre) {
            if (Genre::exists($genre, 'id')) {
                $existingMergedGenres[] = $genre;
            }
        }
        return Artist::createOne($inputs, $existingMergedGenres);
    }

}
