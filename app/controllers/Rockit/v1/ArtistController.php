<?php

namespace Rockit\v1;

use \Rockit\Artist,
    \Rockit\Genre,
    \Rockit\Image,
    \Rockit\Performer,
    \Rockit\Lineup,
    \Rockit\Instrument,
    \Rockit\Controllers\ControllerBSUDTrait,
    \Jsend,
    \Input;

/**
 * Contains interaction methods to the Artist model in the database.<br>
 * Base on the Laravel's BaseController.<br>
 * Can : <b>index</b> all the Artists, <b>save</b>, <b>show</b>, <b>delete</b> and <b>update</b> one Artist.<br>
 * Since Artists are required by an event, the <b>delete</b> is actually a <b>softDelete</b>.
 * 
 * @author Joël Gugger <joel.gugger@heig-vd.ch>
 */
class ArtistController extends \BaseController {

    use ControllerBSUDTrait;

    /**
     * Display a listing of the resource.
     * 
     * It is possible to give extra parameters in order to filter the results.<br>
     * These parameters are :<br>
     * <ul>
     * <li><b>name</b>: an artist's name</li>
     * <li><b>genres</b>: an array of genres id</li>
     * <li><b>musician_name</b>: a musician's name</li>
     * </ul>
     * Each provided attribute reduces the scope of the results.<br>
     * If the Collection posesses more than <b>10</b> items, it will be divided into chunck of <b>10</b> items.<br>
     * This number of returned item can be changed by providing a value to the <b>nb_item</b> attribute.<br>
     * This value can not be lower than <b>0</b>. 
     * 
     * @return Jsend
     */
    public function index() {
        $artists = Artist::with('images', 'genres');
        $nb_item = Input::has('nb_item') && Input::get('nb_item') > 0 ? Input::get('nb_item') : 10;
        if (Input::has('name')) {
            $artists = $artists->name(Input::get('name'));
        }
        if (Input::has('genres')) {
            $artists = $artists->genres(Input::get('genres'));
        }
        if (Input::has('musician_name')) {
            $string = Input::get('musician_name');
            $artists = $artists->musicianStagename($string);
            $artists = $artists->musicianFirstname($string);
            $artists = $artists->musicianLastname($string);
        }
        $paginate = $artists->paginate($nb_item)->toArray();
        $artist_data = $paginate['data'];
        unset($paginate['data']);
        return Jsend::success(array(
            'artists' => $artist_data,
            'paginate' => $paginate,
        ));
    }

    /**
     * Display the specified resource.
     * 
     * Return an Artist with all its relationships.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $artist = Artist::with('links', 'images', 'genres', 'events', 'musicians')
        ->find($id);
        if (empty($artist)) {
            $response = Jsend::fail(array('title' => trans('fail.artist.inexistant')));
        } else {
            foreach ($artist->events as $event) {
                $event->performers = Performer::where('artist_id', '=', $event->pivot->artist_id)
                ->where('event_id', '=', $event->pivot->event_id)
                ->get(['id', 'order', 'is_support', 'artist_hour_of_arrival']);
                unset($event->pivot);
            }
            foreach ($artist->musicians as $musician) {
                $lineups = Lineup::where('artist_id', '=', $musician->pivot->artist_id)
                ->where('musician_id', '=', $musician->pivot->musician_id)
                ->get();
                foreach ($lineups as $lineup) {
                    $instrument = Instrument::where('id', '=', $lineup->instrument_id)->first();
                    $instrument->lineup_id = $lineup->id;
                    $instruments[] = $instrument;
                }
                $musician->instruments = $instruments;
                unset($musician->pivot);
                unset($instruments);
            }
            $response = Jsend::success($artist);
        }
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $inputs = Input::only('name', 'short_description_de', 'complete_description_de', 'genres', 'images');
        $validate = Artist::validate($inputs, Artist::$create_rules);
        if ($validate === true) {
            $response = self::save($inputs);
        } else {
            $response = $validate;
        }
        return Jsend::compile($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $new_data = Input::only('name', 'short_description_de', 'complete_description_de');
        $validate = Artist::validate($new_data, Artist::$update_rules);
        if ($validate === true) {
            $response = self::modify('Artist', $id, $new_data);
        } else {
            $response = $validate;
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
        return Jsend::compile(self::delete('Artist', $id));
    }

    /**
     * Save a new Artist in the database with the given inputs.
     * 
     * Method checks genres to be unique and to be existing before 
     * passing to valid $inputs to createOne method, as well as checking images
     * to be unique and to be existing and not already illustrating an artist.
     * If no existing genre is found, so return a fail message
     * 
     * @param array $inputs
     * @return Message
     */
    public static function save($inputs) {
        $existingMergedGenres = array();
        $inputs['genres'] = array_unique($inputs['genres']);
        foreach ($inputs['genres'] as $genre) {
            if (Genre::exist($genre, 'id')) {
                $existingMergedGenres[] = $genre;
            }
        }
        if (!count($existingMergedGenres) > 0) {
            $response['fail'] = trans('fail.artist.nogenre');
        } else {
            $inputs['genres'] = $existingMergedGenres;
            $existingMergedImages = array();
            $inputs['images'] = array_unique($inputs['images']);
            foreach ($inputs['images'] as $image) {
                if (Image::where('id', '=', $image)->where('artist_id', '=', NULL)->first()) {
                    $existingMergedImages[] = $image;
                }
            }
            $inputs['images'] = $existingMergedImages;
            $response = Artist::createOne($inputs);
        }
        return $response;
    }

}
