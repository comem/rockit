<?php

namespace Rockit\Controllers\v1;

use \Input,
    \Jsend,
    \Validator,
    \Rockit\Models\Artist,
    \Rockit\Models\Genre,
    \Rockit\Models\Image,
    \Rockit\Models\Performer,
    \Rockit\Models\Lineup,
    \Rockit\Models\Instrument,
    \Rockit\Traits\Controllers\ControllerBSUDTrait;

/**
 * Contains interaction methods to the Artist model in the database.<br>
 * Based on the Laravel's BaseController.<br>
 * Can : <b>index</b> all the Artists, <b>store</b>, <b>show</b>, <b>destroy</b> and <b>update</b> one Artist.<br>
 * Since Artists can be linked to an event, the <b>delete</b> is actually a <b>softDelete</b>.
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
     * <li><b>genres</b>: an array of genre ids</li>
     * <li><b>musician_name</b>: a musician's name</li>
     * </ul>
     * Each provided attribute reduces the scope of the results.<br>
     * If the Collection posesses more than <b>10</b> items, it will be divided into pages of <b>10</b> items.<br>
     * This number of returned items can be changed by providing a value to the <b>nb_item</b> attribute.<br>
     * The page number requested can be specified by passing an <b>integer</b> value via the <b>page</b> attribute.<br>
     * If the <b>page</b>'s value is not an integer or point to an inexistant page, the first page will be returned.<br>
     * This value can not be lower than <b>0</b>.<br>
     * Each Artist is returned with its genres and images. 
     * 
     * @return Jsend
     */
    public function index() {
        $artists = Artist::with('images');
        $nb_item = Input::has('nb_item') && Input::get('nb_item') > 0 ? Input::get('nb_item') : 10;
        if (Input::has('name')) {
            $artists = $artists->name(Input::get('name'));
        }
        if (Input::has('genres')) {
            $artists = $artists->genres(Input::get('genres'));
        }
        if (Input::has('musician_name')) {
            $artists = $artists->musicianName(Input::get('musician_name'));
        }
        $paginate = $artists->paginate($nb_item)->toArray();
        $artist_data = $paginate['data'];
        unset($paginate['data']);
        return Jsend::success(array(
            'response' => $artist_data,
            'paginate' => $paginate,
        ));
    }

    /**
     * Display the specified resource.
     * 
     * Return an Artist with all of its relationships.<br>
     * If the provided id does not point to an existing Artist, a <b>Jsend::fail</b> is returned.<br>
     *
     * @param int $id The id of the requested Artist
     * @return Jsend
     */
    public function show($id) {
        $artist = Artist::with('links', 'images', 'events', 'musicians')
        ->find($id);
        if (empty($artist)) {
            $response = Jsend::fail(['artist' => [trans('fail.artist.inexistant')]]);
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
            $response = Jsend::success(['response' => $artist]);
        }
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     * 
     * Get the adequate inputs from the client request and test that each of them pass the validation rules.<br>
     * If any of these inputs fail, a <b>Jsend::fail</b> is returned.<br>
     * If all the inputs are valid, the data is then passed to the <b>save()</b> method.<br>
     *
     * @return Jsend
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
     * If the provided id does not point to an existing Artist, a <b>Jsend::fail</b> is returned.<br>
     * Get the adequate inputs from the client request and test that each of them pass the validation rules.<br>
     * If any of these inputs fail, a <b>Jsend::fail</b> is returned.<br>
     * If all the inputs are valid, the data is then passed to the <b>modify()</b> method.<br>
     *
     * @param int $id The id of the requested Artist
     * @return Jsend
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
     * The provided id is passed to the <b>delete()</b> method that deletes the corresponding model.<br>
     * If the provided id does not point to an existing Artist, a <b>Jsend::fail</b> is returned.<br>
     * 
     * @param int $id The id of the requested Artist
     * @return Jsend
     */
    public function destroy($id) {
        return Jsend::compile(self::delete('Artist', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * The provided id is passed to the <b>delete()</b> method that deletes the corresponding model.<br>
     * If the provided id does not point to an existing Artist, a <b>Jsend::fail</b> is returned.<br>
     * 
     * @param int $id The id of the requested Artist
     * @return Jsend
     */
     /**
     * Store a new association between an Artist and an Image that illustrates that Artist.
     * 
     * Get the image id from the client request and test that it points to an existing Image.<br>
     * Check that the artist id provided points to an existing Artist.<br>
     * If either of these two checks fail, a <b>Jsend::fail</b> is returned.<br>
     * If all the inputs are valid, the data is then passed to the <b>save()</b> method, who sends back a response.<br>
     *
     * @return Jsend
     */
    public function illustrate($id) {
        $inputs['artist_id'] = (int) $id;
        $inputs['image_id'] = Input::get('image_id');
        $v = Validator::make(
        $inputs, [
            'artist_id' => 'required|exists:artists,id',
            'image_id' => 'required|exists:images,id']
        );
        if ($v->passes()) {
            $response = IllustrationController::save($inputs);
        } else {
            $response['fail'] = $v->messages()->getMessages();
        }
        return Jsend::compile($response);
    }


    public function desillustrate($artist_id, $image_id) {
        $image = Image::exist($image_id);
        if (is_object($image)) {
            if ($image->artist_id == $artist_id OR $image->artist_id == NULL) {
                $response = IllustrationController::delete($image);
            } else {
                $response['fail'] = [
                    'image' => [trans('fail.illustration.inadequate')]
                ];
            }
        } else {
            $response['fail'] = [
                'image' => [trans('fail.image.inexistant')],
            ];
        }
        return Jsend::compile($response);
    }

    /**
     * Save a new Artist in the database with the given inputs.
     * 
     * Check that there's not two identical genre ids in the set of provided genres ids and that each of these genre ids point to an existing genre.<br>
     * Check also that there's not two identical image ids in the set of provided images ids and that each of these images ids point to an existing image.<br>
     * If one genre id or image id does not point to an existing resource, a <b>Jsend::fail</b> is returned. Or else, the data is passed to the <b>Artist::creatOne()</b> method.<br>
     * 
     * @param array $inputs
     * @return Jsend
     */
    public static function save($inputs) {
        $existingMergedGenres = [];
        $inputs['genres'] = array_unique($inputs['genres']);
        //$fails['genres'] = [];
        foreach ($inputs['genres'] as $key => $genre) {
            if (Genre::exist($genre, 'id')) {
                $existingMergedGenres[] = $genre;
            } else {
                $fails['genres'][] = trans('fail.artist.genre', ['key' => ++$key]);
            }
        }
        $inputs['genres'] = $existingMergedGenres;
        if (isset($inputs['images'])) {
            $existingMergedImages = array();
            $inputs['images'] = array_unique($inputs['images']);
            //$fails['images'] = [];
            foreach ($inputs['images'] as $key => $image) {
                if (Image::where('id', '=', $image)->where('artist_id')->first()) {
                    $existingMergedImages[] = $image;
                } else {
                    $fails['images'][] = trans('fail.artist.image', ['key' => ++$key]);
                }
            }
            $inputs['images'] = $existingMergedImages;
        }
        if (isset($fails['genres']) || isset($fails['images'])) {
            if (!count($existingMergedGenres) > 0) {
                $fails['genres'][] = trans('fail.artist.nogenre');
            }
            $response['fail'] = $fails;
        } else {
            $response = Artist::createOne($inputs);
        }
        return $response;
    }

}
