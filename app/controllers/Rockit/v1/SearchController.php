<?php

namespace Rockit\v1;

use \Jsend;

use \Rockit\Event, \Rockit\Artist, \Rockit\Representer;

/**
 * 
 * @author Joël Gugger <joel.gugger@heig-vd.ch>
 */
class SearchController extends \BaseController {



    /**
     * Display a listing of the resource.
     * 
     * 
     * 
     * @return Jsend
     */
    public function index() {
        $events = Event::select();
        $artists = Artist::select();
        $representers = Representer::select();
        if (Input::has('query')) {
            $query = Input::get('query');
            $res_events = $events->title($query)->get();
            $res_artists = $events->name($query)->get();
            $res_representers = $events->name($query)->get();

            $response['success'] = ['response' => []];
        } else {
            $response['success'] = ['response' => []];
        }

        return Jsend::compile($response);
    }


}
