<?php

namespace Rockit\v1;

use \Jsend, \Input;

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
        $events = Event::select(['id', 'title_de']);
        $artists = Artist::select(['id', 'name']);
        $representers = Representer::select(['id', 'first_name', 'last_name']);
        if (Input::has('query')) {
            $query = Input::get('query');
            $res_events = $events->title($query)->get();
            $res_artists = $artists->name($query)->get();
            $res_representers = $representers->name($query)->get();
            $res = [];
            foreach($res_events as $event){
                $event['type'] = trans('hci.DropdownEvent');
                $event['class'] = 'Event';
                $event['value'] = $event['title_de'];
                unset($event['title_de']);
                $res[] = $event;
            }
            foreach($res_artists as $artist){
                $artist['type'] = trans('hci.DropdownArtist');
                $event['class'] = 'Artist';
                $event['value'] = $event['name'];
                unset($event['name']);
                $res[] = $artist;
            }
            foreach($res_representers as $representer){
                $representer['type'] = trans('hci.DropdownRepresenter');
                $event['class'] = 'Representer';
                $event['value'] = $event['first_name'].' '.$event['last_name'];
                unset($event['first_name']);
                unset($event['last_name']);
                $res[] = $representer;
            }
            $response['success'] = ['response' => $res];
        } else {
            $response['success'] = ['response' => []];
        
        return Jsend::compile($response);
    }


}
