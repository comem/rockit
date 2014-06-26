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
                            'ticketCategories', 'platforms', 'printingTypes', 'artists', 
                            'members', 'skills', 'gifts', 'equipments');
        if (Input::has('name')) {
            //$events = $events->name(Input::get('name'));
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
