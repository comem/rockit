<?php

namespace Rockit\v1;

use \Input,
    \Jsend,
    \Rockit\Image,
    \Rockit\Controllers\ControllerBSUDTrait;

class ImageController extends \BaseController {

    use ControllerBSUDTrait;

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
                $response['success'] = ['images' => Image::whereRaw('artist_id IS NOT NULL')->get()];
            } else {
                $response['success'] = ['images' => Image::whereRaw('artist_id IS NULL')->get()];
            }
        } else {
            $response['success'] = ['images' => Image::all()];
        }
        return Jsend::compile($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $image = Image::find($id);
        if (is_object($image)) {
            $response['success'] = ['images' => $image];
        } else {
            $response['fail'] = ['image' => [trans('fail.image.inexistant')]];
        }
        return Jsend::compile($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $data = Input::only('source', 'alt_de', 'caption_de');
        $response = Image::validate($data, Image::$create_rules);
        if ($response === true) {
            $response = self::save('Image', $data, true, 'source');
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
        $data = Input::only('source', 'alt_de', 'caption_de');
        $response = Image::validate($data, Image::$update_rules);
        if ($response === true) {
            $response = self::modify('Image', $id, $data);
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
        return Jsend::compile(self::delete('Image', $id));
    }

}
