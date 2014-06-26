<?php

namespace Rockit\v1;

use \Jsend,
    \Input,
    \WordExport;
use \Rockit\Event;

class EventController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() 
    {
        $events = Event::with('representer', 'eventType', 'image', 
                            'tickets.ticketCategory', 'sharings.platform', 'printings.printingType', 
                            'performers.artist', 'staffs.member', 'staffs.skill', 'needs.skill', 'offers.gift', 
                            'attributions.equipment');
        if (Input::has('genres')) {
            $events = $events->artistGenres(Input::get('genres'));
        }
        if (Input::has('event_types')) {
            $events = $events->eventType(Input::get('event_types'));
        }
        if (Input::has('is_published')) {
            $is_published = Input::get('is_published');
            if($is_published == '1') $events = $events->isPublished(TRUE);
            else $events = $events->isPublished(FALSE);
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
            if($is_followed_by_private == '1') $events = $events->isFollowedByPrivate(TRUE);
            else $events = $events->isFollowedByPrivate(FALSE);
        }
        if (Input::has('has_representer')) {
            $has_representer = Input::get('has_representer');
            if($has_representer == '1') $events = $events->hasRepresenter(TRUE);
            else $events = $events->hasRepresenter(FALSE);
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
        $events = Event::with('representer', 'eventType', 'image', 
                            'ticketCategories', 'platforms', 'printingTypes', 'artists', 
                            'members', 'skills', 'gifts', 'equipments');
        return Jsend::success($events->find($id));
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
        //
    }

    /**
     * Unpublish the specified ressource.
     *
     * @param  int  $id
     * @return Response
     */
    public function unpublish($id) {
        //
    }

    /**
     * Export events to word
     *
     * @param
     * @return Response
     */
    public function exportWord() {
        $from = Input::get('from');
        $to = Input::get('to');
        WordExport::events($from, $to);
    }

    /**
     * Export events to XML
     *
     * @param
     * @return Response
     */
    public function exportXML() {
        //
    }

}
