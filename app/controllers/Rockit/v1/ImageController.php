<?php

namespace Rockit\v1;

use \Input,
    \Jsend,
    \Rockit\Image,
    \Rockit\Controllers\ControllerBSUDTrait;

/**
 * Contains interaction methods to the Image model in the database.<br>
 * Based on the Laravel's BaseController.<br>
 * Can : <b>index</b> all the Images, <b>show</b>, <b>destroy</b> and <b>update</b> one Image.<br>
 * Since Images can be linked to an event, the <b>delete</b> is actually a <b>softDelete</b>.
 * 
 * @author ??
 */
class ImageController extends \BaseController {
 
    use ControllerBSUDTrait;

    /**
     * Display a listing of the resource.
     * 
     * Each Image is returned with its own information.
     * TO REVIEW line 33-35 
     * 
     * @return Jsend
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
     * Return an Image with all of its relationships.<br>
     * If the provided id does not point to an existing Image, a <b>Jsend::fail</b> is returned.<br>
     *
     * @param int $id The id of the requested Image
     * @return Jsend
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
     * Get the adequate inputs from the client request and test that each of them pass the validation rules.<br>
     * If any a these inputs fails, a <b>Jsend::fail</b> is returned.<br>
     * If all the inputs are valid, the data is then passed to the <b>save()</b> method.<br>
     *
     * @return Jsend
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
     * If the provided id does not point to an existing Image, a <b>Jsend::fail</b> is returned.<br>
     * Get the adequate inputs from the client request and test that each of them pass the validation rules.<br>
     * If any a these inputs fail, a <b>Jsend::fail</b> is returned.<br>
     * If all the inputs are valid, the data is then passed to the <b>modify()</b> method.<br>
     *
     * @param int $id The id of the requested Image
     * @return Jsend
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
     * If the provided id does not point to an existing Image, a <b>Jsend::fail</b> is returned.<br>
     * Or else this id is then passed to the <b>delete()</b> method that deletes the corresponding model.
     * 
     * @param int $id The id of the requested Image
     * @return Jsend
     */
    public function destroy($id) {
        return Jsend::compile(self::delete('Image', $id));
    }

}
