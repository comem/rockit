<?php

namespace Rockit\Controllers\v1;

use \Input,
    \Validator,
    \Jsend,
    \Rockit\Models\Image,
    \Rockit\Models\Event;

/**
 * A Symbolization is the link between an Event and an Image.<br>
 * Contains interaction methods for the relationship between an Image and the Event it symbolizes.<br>
 * Based on the Laravel's BaseController.<br>
 * Can : <b>store</b> and <b>destroy</b> an association between an Image and an Event.<br>
 * 
 * @author Joël Gugger <joel.gugger@heig-vd.ch>
 */
class SymbolizationController extends \BaseController {

    /**
     * Store a new association between an Image and the Event it illustrates.
     * 
     * Get the adequate inputs from the client request and test that each of them pass the validation rules.<br>
     * If any of these inputs fails, a <b>Jsend::fail</b> is returned.<br>
     * If all the inputs are valid, the data is then passed to the <b>save()</b> method, who sends back a response.<br>
     *
     * @return Jsend
     */
    public function store() {
        $inputs = Input::only('event_id', 'image_id');
        $v = Validator::make(
        $inputs, [
            'event_id' => 'required|exists:events,id',
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
     * Destroy the association between an Image and an Event, from the provided image id.
     *
     * If the image id does not point to an existing Image, a <b>Jsend::fail</b> is returned.<br>
     * Or else the the Image is passed to the <b>delete()</b> method.<br>
     * 
     * 
     * @param int $id The id of the Image that will no longer symbolize an Event
     * @return Jsend
     */
    public function destroy($id) {
        $event = Event::exist($id);
        if (is_object($event)) {
            $response = self::delete($event);
        } else {
            $response['fail'] = [
                'title' => trans('fail.event.inexistant'),
            ];
        }
        return Jsend::compile($response);
    }

    /**
     * Save a new relationship between an existing Image and an existing Event with the given inputs.
     * 
     * The Image provided in the inputs must illustrate an Artist that performs in the Event provided.<br>
     * If the Image does not illustrate a performing Artist in the Event, a <b>Jsend::fail</b> is returned.
     * If the Image provided already symbolizes an Event, a <b>Jsend::fail</b> is returned.<br>
     * Or else the inputs are passed to the <b>updateOne</b> method of the Image model.<br>
     *
     * @param array $inputs An array containing a valid image id and a valid event id 
     * @return Jsend
     */
    public static function save($inputs) {
        $event = Event::find($inputs['event_id']);
        if (empty($event->image_id)) {
            $image = Image::find($inputs['image_id']);
            if (!empty($image->artist_id)) {
                $checkPerformer = Image::checkPerformer($image, $event);
                if ($checkPerformer !== true) {
                    return $checkPerformer;
                }
            }
            $update = Event::updateOne(['image_id' => $image->id], $event);
            if (isset($update['success'])) {
                $response['success'] = [
                    'title' => trans('success.symbolization.created'),
                    'id' => $event->id,
                ];
            } else {
                $response['error'] = trans('error.symbolization.created');
            }
        } else {
            $response['fail'] = [
                'title' => trans('fail.symbolization.existing')
            ];
        }
        return $response;
    }

    /**
     * Remove a relationship between an existing Image and an existing Event, from the provided Image.
     *
     * If the Image provided does not symbolize an Event, a <b>Jsend::fail</b> is returned.<br>
     * If the delete was not completed, a <b>Jsend::error</b> is returned.<br>
     * Or else a <b>Jsend::success</b> is returned.<br>
     * 
     * @param Image $image The Image that symbolizes an Event, whose association is to be deleted
     * @return array Contains an array with either a <b>fail</b>, <b>error</b> or <b>success</b> key and its corresponding message
     */
    public static function delete(Event $event) {
        if (empty($event->image_id)) {
            $response['fail'] = [
                'title' => trans('fail.symbolization.inexistant')
            ];
        } else {
            $event->image_id = NULL;
            if ($event->save()) {
                $response['success'] = [
                    'title' => trans('success.symbolization.deleted'),
                ];
            } else {
                $response['error'] = trans('error.symbolization.deleted');
            }
        }
        return $response;
    }

}
