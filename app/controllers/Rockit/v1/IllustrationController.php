<?php

namespace Rockit\v1;

use \Input,
    \Validator,
    \Rockit\Image,
    \Jsend;

/**
 * An Illustration is the link between an Artist and an Image.<br>
 * Contains interaction methods for the relationship between an Image and the Artist it illustrates.<br>
 * Based on the Laravel's BaseController.<br>
 * Can : <b>store</b> and <b>destroy</b> an association between an Image and an Artist.<br>
 * 
 * @author Joël Gugger <joel.gugger@heig-vd.ch>
 */
class IllustrationController extends \BaseController {

    /**
     * Store a new association between an Image and the Artist it illustrates.
     * 
     * Get the adequate inputs from the client request and test that each of them pass the validation rules.<br>
     * If any of these inputs fails, a <b>Jsend::fail</b> is returned.<br>
     * If all the inputs are valid, the data is then passed to the <b>save()</b> method, who sends back a response.<br>
     *
     * @return Jsend
     */
    public function store() {
        $inputs = Input::only('artist_id', 'image_id');
        $v = Validator::make(
        $inputs, [
            'artist_id' => 'required|exists:artists,id',
            'image_id' => 'required|exists:images,id']
        );
        if ($v->passes()) {
            $response = self::save($inputs);
        } else {
            $response['fail'] = $v->messages()->getMessages();
        }
        return Jsend::compile($response);
    }

    /**
     * Destroy the association between an Image and an Artist, from the provided image id.
     *
     * If the image id does not point to an existing Image, a <b>Jsend::fail</b> is returned.<br>
     * Or else the the Image is passed to the <b>delete()</b> method.<br>
     * 
     * 
     * @param int $id The id of the Image that will no longer illustrate an Artist
     * @return Jsend
     */
    public function destroy($id) {
        $image = Image::exist($id);
        if (is_object($image)) {
            $response = self::delete($image);
        } else {
            $response['fail'] = [
                'image' => [trans('fail.image.inexistant')],
            ];
        }
        return Jsend::compile($response);
    }


    /**
     * Save a new relationship between an existing Image and an existing Artist with the given inputs.
     * 
     * If the provided image id corresponds to an Image that already illustrates an Artist, a <b>Jsend::fail</b> is returned.<br>
     * Or else the inputs are passed to the <b>updateOne</b> method of the Image model.<br>
     *
     * @param array $inputs An array containing a valid image id and a valid artist id 
     * @return Jsend
     */
    public static function save($inputs) {
        $image = Image::find($inputs['image_id']);
        if (empty($image->artist_id)) {
            $update = Image::updateOne(['artist_id' => $inputs['artist_id']], $image);
            if (isset($update['success'])) {
                $response['success'] = [
                    'title' => trans('success.illustration.created'),
                    'id' => $image->id,
                ];
            } else {
                $response['error'] = trans('error.illustration.created');
            }
        } else {
            $response['fail'] = [
                'illustration' => [trans('fail.illustration.existing')]
            ];
        }
        return $response;
    }

    /**
     * Remove a relationship between an existing Image and an existing Artist, with the given Image.
     *
     * If the Image provided does not illustrate an Artist, a <b>Jsend::fail</b> is returned.<br>
     * If the delete was not completed, a <b>Jsend::error</b> is returned.<br>
     * Or else a <b>Jsend::success</b> is returned.<br>
     * 
     * @param Image $image The Image that illustrates an Artist, whose association is to be deleted
     * @return array Contains an array with either a <b>fail</b>, <b>error</b> or <b>success</b> key and its corresponding message
     */
    public static function delete($image) {
        if (empty($image->artist_id)) {
            $response['fail'] = [
                'illustration' => [trans('fail.illustration.inexistant')]
            ];
        } else {
            $image->artist_id = NULL;
            if ($image->save()) {
                $response['success'] = [
                    'title' => trans('success.illustration.deleted'),
                ];
            } else {
                $response['error'] =  trans('error.illustration.deleted');
            }
        }
        return $response;
    }

}
