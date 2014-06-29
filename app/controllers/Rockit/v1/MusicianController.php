<?php

namespace Rockit\v1;

use \Rockit\Controllers\ControllerBSUDTrait,
    \Rockit\Musician,
    \Rockit\Instrument,
    \Rockit\Artist,
    \Rockit\Lineup,
    \Input,
    \Jsend;

/**
 * Contains interaction methods to the Musician model in the database.<br>
 * Based on the Laravel's BaseController.<br>
 * Can : <b>index</b> all the Musicians, <b>store</b>, <b>show</b>, <b>destroy</b> and <b>update</b> one Musician.<br>
 * Since Musicians can be linked to an event, the <b>delete</b> is actually a <b>softDelete</b>.
 * 
 * @author Christian Heimann <christian.heimann@heig-vd.ch>
 */
class MusicianController extends \BaseController {

    use ControllerBSUDTrait;

    /**
     * Display a listing of the resource.
     * 
     * Each Musician is returned with its artists and its lineup. 
     * 
     * @return Jsend
     */
    public function index() {
        $musicians = Musician::with('artists')->get();
        foreach ($musicians as $musician) {
            foreach ($musician->artists as $artist) {
                $lineups = Lineup::where('artist_id', '=', $artist->pivot->artist_id)
                        ->where('musician_id', '=', $artist->pivot->musician_id)
                        ->get();
                foreach ($lineups as $lineup) {
                    $instrument = Instrument::where('id', '=', $lineup->instrument_id)->first();
                    $instrument->lineup_id = $lineup->id;
                    $instruments[] = $instrument;
                }
                $artist->instruments = $instruments;
                unset($artist->pivot);
                unset($instruments);
            }
        }
        return Jsend::success($musicians->toArray());
    }

    /**
     * Display the specified resource.
     * 
     * Return a Musician with all of its relationships.<br>
     * If the provided id does not point to an existing Musician, a <b>Jsend::fail</b> is returned.<br>
     *
     * @param int $id The id of the requested Musician
     * @return Jsend
     */
    public function show($id) {
        $musician = Musician::with('artists')->find($id);
        if (empty($musician)) {
            $response = Jsend::fail(array('title' => trans('fail.musician.inexistant')));
        } else {
            foreach ($musician->artists as $artist) {
                $lineups = Lineup::where('artist_id', '=', $artist->pivot->artist_id)
                        ->where('musician_id', '=', $artist->pivot->musician_id)
                        ->get();
                foreach ($lineups as $lineup) {
                    $instrument = Instrument::where('id', '=', $lineup->instrument_id)->first();
                    $instrument->lineup_id = $lineup->id;
                    $instruments[] = $instrument;
                }
                $artist->instruments = $instruments;
                unset($artist->pivot);
                unset($instruments);
            }
            $response = Jsend::success($musician);
        }
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     * 
     * Get the adequate inputs from the client request and test that each of them pass the validation rules.<br>
     * If any a these inputs fails, a <b>Jsend::fail</b> is returned.<br>
     * If all the inputs are valid, the data is then passed to the <b>save()</b> method.<br>
     *
     * @return Jsend
     */
    public function store() {
        $inputs = Input::only('first_name', 'last_name', 'stagename', 'lineups');
        $validate = Musician::validate($inputs, Musician::$create_rules);
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
     * If the provided id does not point to an existing Musician, a <b>Jsend::fail</b> is returned.<br>
     * Get the adequate inputs from the client request and test that each of them pass the validation rules.<br>
     * If any a these inputs fail, a <b>Jsend::fail</b> is returned.<br>
     * If all the inputs are valid, the data is then passed to the <b>modify()</b> method.<br>
     *
     * @param int $id The id of the requested Musician
     * @return Jsend
     */
    public function update($id) {
        $inputs = Input::only('first_name', 'last_name', 'stagename');
        $validate = Musician::validate($inputs, Musician::$update_rules);
        if ($validate === true) {
            $response = self::modify('Musician', $id, $inputs);
        } else {
            $response = $validate;
        }
        return Jsend::compile($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * If the provided id does not point to an existing Musician, a <b>Jsend::fail</b> is returned.<br>
     * Or else this id is then passed to the <b>delete()</b> method that deletes the corresponding model.
     * 
     * @param int $id The id of the requested Musician
     * @return Jsend
     */
    public function destroy($id) {
        return Jsend::compile(self::delete('Musician', $id));
    }

    /**
     * Save a new Musician in the database with the given inputs.
     * 
     * Checks if each artist and instrument combination is unique, and merges equal combinations into one.<br>
     * Then reset the input['lineups'] with the result. Impossible results are ignored.<br>
     * If there is not atleast one valid lineup set, a <b>Jsend::fail</b> is returned. Or else, the data is passed to the <b>createOne()</b> method of the Musician model.<br>
     * 
     * @param array $inputs
     * @return Jsend
     */
    public static function save($inputs) {
        $existingLineups = array();
        foreach ($inputs['lineups'] as $lineup) {
            if (Instrument::exist($lineup['instrument_id']) && Artist::exist($lineup['artist_id']) && !in_array($lineup, $existingLineups)) {
                $existingLineups[] = $lineup;
            }
        }
        if (!count($existingLineups) > 0) {
            $response['fail'] = ['title' => trans('fail.musician.nolineup')];
        } else {
            $inputs['lineups'] = $existingLineups;
            $response = Musician::createOne($inputs);
        }
        return $response;
    }

}
