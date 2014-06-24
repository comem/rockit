<?php

namespace Rockit\v1;

use \Rockit\Artist,
    \Rockit\Genre,
    \Rockit\Image,    
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
        $inputs = Input::only('name', 'short_description_de', 'complete_description_de', 'genres', 'images');
        $validate = Artist::validate($inputs, Artist::$create_rules);
        if ($validate === true) {
            $response = self::save($inputs);
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
        $validate = Artist::validate($new_data, Artist::$update_rules);
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

    /**
     * Method checks genres to be unique and to be existing before 
     * passing to valid $inputs to createOne method, as well as checking images
     * to be unique and to be existing and not already illustrating an artist.
     * @param type $inputs
     * @return Message
     */
    public static function save($inputs) {
        $existingMergedGenres = array();
        $inputs['genres'] = array_unique($inputs['genres']);
        foreach ($inputs['genres'] as $genre) {
            if (Genre::exists($genre, 'id')) {
                $existingMergedGenres[] = $genre;
            }
        }
        $inputs['genres'] = $existingMergedGenres;
        $existingMergedImages = array();
        $inputs['images'] = array_unique($inputs['images']);
        foreach($inputs['images'] as $image) {
            if (Image::where('id', '=', $image)->where('artist_id', '=', NULL)->first()) {
                $existingMergedImages[] = $image; 
            }
        }
        $inputs['images'] = $existingMergedImages;
        return Artist::createOne($inputs);
    }

}
