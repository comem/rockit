<?php

namespace Rockit\v1;

use \Rockit\Controllers\ControllerBSUDTrait;
use \Jsend,
    \Input,
    \WordExport,
    \XMLExport,
    \Validator;
use \Rockit\Event;

class EventController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $events = Event::with('representer', 'eventType', 'image', 'tickets.ticketCategory', 'sharings.platform', 'printings.printingType', 'performers.artist', 'staffs.member', 'staffs.skill', 'needs.skill', 'offers.gift', 'attributions.equipment');
        if (Input::has('genres')) {
            $events = $events->artistGenres(Input::get('genres'));
        }
        if (Input::has('event_types')) {
            $events = $events->eventType(Input::get('event_types'));
        }
        if (Input::has('is_published')) {
            $is_published = Input::get('is_published');
            if ($is_published == '1')
                $events = $events->isPublished(TRUE);
            else
                $events = $events->isPublished(FALSE);
        }
        if (Input::has('title')) {
            $events = $events->title(Input::get('title'));
        }
        if (Input::has('from')) {
            $events = $events->from(Input::get('from'));
        } else {
            $events = $events->from(date('Y-m-d H:i:s'));
        }
        if (Input::has('to')) {
            $events = $events->to(Input::get('to'));
        }
        if (Input::has('artist_name')) {
            $events = $events->artistName(Input::get('artist_name'));
        }
        if (Input::has('platforms')) {
            $events = $events->platforms(Input::get('platforms'));
        }
        if (Input::has('is_followed_by_private')) {
            $is_followed_by_private = Input::get('is_followed_by_private');
            if ($is_followed_by_private == '1')
                $events = $events->isFollowedByPrivate(TRUE);
            else
                $events = $events->isFollowedByPrivate(FALSE);
        }
        if (Input::has('has_representer')) {
            $has_representer = Input::get('has_representer');
            if ($has_representer == '1')
                $events = $events->hasRepresenter(TRUE);
            else
                $events = $events->hasRepresenter(FALSE);
        }
        return Jsend::success($events->paginate(10)->toArray());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $event = Event::with('representer', 'eventType', 'image', 'tickets.ticketCategory', 'sharings.platform', 'printings.printingType', 'performers.artist', 'staffs.member', 'staffs.skill', 'needs.skill', 'offers.gift', 'attributions.equipment');
        if (empty($event)) {
            $response = Jsend::fail(array('title' => trans('fail.event.inexistant')));
        } else {
            $response = Jsend::success($event->find($id));
        }
        return $response;
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

    /**
     * Publish the specified ressource.
     *
     * @param  int  $id
     * @return Response
     */
    public function publish($id) {
        $response = Event::exist($id);
        if (is_object($response)) {
            $response = self::sfPublish($response);
        } else {
            $response['fail'] = ['title' => trans('fail.event.inexistant')];
        }
        return Jsend::compile($response);
    }

    /**
     * Unpublish the specified ressource.
     *
     * @param  int  $id
     * @return Response
     */
    public function unpublish($id) {
        $response = Event::exist($id);
        if (is_object($response)) {
            $response = self::sfUnpublish($response);
        } else {
            $response['fail'] = ['title' => trans('fail.event.inexistant')];
        }
        return Jsend::compile($response);
    }

    /**
     * Export events between the two dates (including them) to a well formatted
     * word document with Mahogany Hall headers and footers.
     * @return Response a Word.docx or a fail.
     */
    public function exportWord() {
        $from = Input::get('from');
        $to = Input::get('to');
        if (isset($from) && isset($to)) {
            $v = Validator::make(array('from' => $from, 'to' => $to), array('from' => 'date|required', 'to' => 'date|required'));
            if ($v->fails()) {
                $response['fail'] = $v->messages()->getMessages();
                return Jsend::compile($response);
            } elseif (Event::checkDatesChronological($from, $to) === true) {
                WordExport::events($from, $to) === true;
                // if a WordExport succeeds, there should no answer be returned. If there is a return,
                // the wordfile gets corrupt. So it's not possible to make $response['success'] = ['title' => trans('success.wordexport.create')];
            } else {
                $response['fail'] = ['title' => trans('fail.export.unchronological')];
                return Jsend::compile($response);
            }    
        } else {
            $response['fail'] = ['title' => trans('fail.export.noinput')];
            return Jsend::compile($response);
        }
    }

    /**
     * Export events between the two dates (including them) to a XML document.
     *
     * @param
     * @return Response
     */
    public function exportXML() {
        $from = Input::get('from');
        $to = Input::get('to');
        if (isset($from) && isset($to)) {
            $v = Validator::make(array('from' => $from, 'to' => $to), array('from' => 'date|required', 'to' => 'date|required'));
            if ($v->fails()) {
                $response['fail'] = $v->messages()->getMessages();
                return Jsend::compile($response);
            } elseif (Event::checkDatesChronological($from, $to) === true) {
                XMLExport::events($from, $to) === true;
                // if a WordExport succeeds, there should no answer be returned. If there is a return,
                // the wordfile gets corrupt. So it's not possible to make $response['success'] = ['title' => trans('success.wordexport.create')];
            } else {
                $response['fail'] = ['title' => trans('fail.export.unchronological')];
                return Jsend::compile($response);
            }    
        } else {
            $response['fail'] = ['title' => trans('fail.export.noinput')];
            return Jsend::compile($response);
        }
    }

    public static function sfUnpublish($event) {
        return Event::updateOne(['published_at' => NULL], $event);
    }

    public static function sfPublish($event) {
        $response = Event::atLeastOneMainPerformer($event);
        if ($response === true) {
            $response = Event::isSymbolized($event);
            if ($response === true) {
                $response = Event::updateOne(['published_at' => date('Y-m-d H:i:s')], $event);
            }
        }
        return $response;
    }

}
