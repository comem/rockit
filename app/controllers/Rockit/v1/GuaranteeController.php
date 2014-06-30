<?php

namespace Rockit\v1;

use \Input,
    \Validator,
    \Jsend,
    \Rockit\Event,
    \Rockit\Representer;

/**
 * A Guarantee is the link between an Event and a Representer that guarantees that Event.<br>
 * Contains interaction methods for the relationship between an Event and a Representer.<br>
 * Based on the Laravel's BaseController.<br>
 * Can : <b>store</b> and <b>destroy</b> an association between an Image and an Event.<br>
 * 
 * @author Joël Gugger <joel.gugger@heig-vd.ch>
 */
class GuaranteeController extends \BaseController {

    /**
     * Store a new association between an Event and a Representer that guarantees that Event.
     * 
     * Get the adequate inputs from the client request and test that each of them pass the validation rules.<br>
     * If any of these inputs fails, a <b>Jsend::fail</b> is returned.<br>
     * If all the inputs are valid, the data is then passed to the <b>save()</b> method, who sends back a response.<br>
     *
     * @return Jsend
     */
    public function store() {
        $inputs = Input::only('representer_id', 'event_id');
        $v = Validator::make(
        $inputs, [
            'representer_id' => 'required|exists:representers,id',
            'event_id' => 'required|exists:events,id']
        );
        if ($v->passes()) {
            $response = self::save($inputs);
        } else {
            $response['fail'] = $v->messages()->getMessages();
        }
        return Jsend::compile($response);
    }

    /**
     * Destroy the association between an Event and a Representer that guarantees that Event, from the provided event id.
     *
     * If the event id does not point to an existing Event, a <b>Jsend::fail</b> is returned.<br>
     * Or else the the Event is passed to the <b>delete()</b> method.<br>
     * 
     * 
     * @param int $id The id of the Event that will no longer be guaranteed by its Representer
     * @return Jsend
     */
    public function destroy($id) {
        $event = Event::exist($id);
        if (is_object($event)) {
            $response = self::delete($event);
        } else {
            $response['fail'] = [
                'event' => [trans('fail.event.inexistant')],
            ];
        }
        return Jsend::compile($response);
    }

    /**
     * Save a new relationship between an Event and a Representer that guarantees that Event, with the given inputs.
     * 
     * The Event provided in the inputs must illustrate an Event that is not already guaranteed by a Representer.<br>
     * If a Guarantee already exists for this Event, a <b>Jsend::fail</b> is returned.
     * If the Guarantee could not be saved, a <b>Jsend::error</b> is returned.<br>
     * Or else the inputs are passed to the <b>updateOne</b> method of the Event model.<br>
     *
     * @param array $inputs An array containing a valid event id and a valid representer id 
     * @return Jsend
     */
    public static function save($inputs) {
        $event = Event::find($inputs['event_id']);
        if (empty($event->representer_id)) {
            $update = Event::updateOne(['representer_id' => $inputs['representer_id']], $event);
            if (isset($update['success'])) {
                $representer_name = Representer::find($inputs['representer_id'])->first_name;
                $response['success'] = [
                    'title' => trans('success.guarantee.created', ['name' => $representer_name]),
                    'id' => $event->id,
                ];
            } else {
                $response['error'] = trans('error.guarantee.created');
            }
        } else {
            $response['fail'] = [
                'guarantee' => [trans('fail.guarantee.existing')]
            ];
        }
        return $response;
    }

    /**
     * Remove a relationship between an Event and a Representer that guarantees that Event.
     *
     * If the Event provided is not guaranteed by a Representer, a <b>Jsend::fail</b> is returned.<br>
     * If the delete was not completed, a <b>Jsend::error</b> is returned.<br>
     * Or else a <b>Jsend::success</b> is returned.<br>
     * 
     * @param Event $event The Event that is guaranteed by a Representer, whose association is to be deleted
     * @return array Contains an array with either a <b>fail</b>, <b>error</b> or <b>success</b> key and its corresponding message
     */
    public static function delete(Event $event) {
        if (empty($event->representer_id)) {
            $response['fail'] = [
                'guarantee' => [trans('fail.guarantee.inexistant')]
            ];
        } else {
            $field = $event->representer->first_name;
            $event->representer_id = NULL;
            if ($event->save()) {
                $response['success'] = [
                    'title' => trans('success.guarantee.deleted', ['name' => $field]),
                ];
            } else {
                $response['error'] = trans('error.guarantee.deleted');
            }
        }
        return $response;
    }

}
