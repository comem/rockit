<?php

namespace Rockit\v1;

use \Input,
    \Validator,
    \Rockit\Image,
    \Rockit\Event,
    \Jsend;

class SymbolizationController extends \BaseController {

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $inputs = Input::only('event_id', 'image_id');
        $v = Validator::make(
        $inputs, ['event_id' => 'required|exists:events,id',
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
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
                $response['error'] = [
                    'title' => trans('error.symbolization.created')
                ];
            }
        } else {
            $response['fail'] = [
                'title' => trans('fail.symbolization.existing')
            ];
        }
        return $response;
    }

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
                $response['error'] = [
                    'title' => trans('error.symbolization.deleted')
                ];
            }
        }
        return $response;
    }

}
