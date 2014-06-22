<?php

namespace Rockit\v1;

use \Input,
    \Rockit\Image;

class ImageController extends \BaseController {

    /**
     * Display a listing of the resource.
     * 
     *
     * @return Response
     */
    public function index() {
        if (Input::has('is_illustration')) {
            $illustrates = filter_var(Input::get('is_illustration'), FILTER_VALIDATE_BOOLEAN);
            if ($illustrates) {
                $response = Image::whereRaw('artist_id IS NOT NULL')->get();
            } else {
                $response = Image::whereRaw('artist_id IS NULL')->get();
            }
        } else {
            $response = Image::all();
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
