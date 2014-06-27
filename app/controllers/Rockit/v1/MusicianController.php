<?php

namespace Rockit\v1;

use \Rockit\Controllers\ControllerBSUDTrait,
    \Rockit\Musician,
    \Rockit\Instrument,
    \Rockit\Artist,
    \Rockit\Lineup,
    \Input,
    \Jsend;

class MusicianController extends \BaseController {
    
    use ControllerBSUDTrait;

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$musicians = Musician::with('artists')->get();
		foreach($musicians as $musician){
	        foreach($musician->artists as $artist){
	            $lineups = Lineup::where('artist_id', '=', $artist->pivot->artist_id)
	                            ->where('musician_id', '=', $artist->pivot->musician_id)
	                            ->get();
	            foreach($lineups as $lineup){
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
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $musician = Musician::with('artists')->find($id);
        if (empty($musician)) {
            $response = Jsend::fail(array('title' => trans('fail.musician.inexistant')));
        } else {
			foreach($musician->artists as $artist){
			    $lineups = Lineup::where('artist_id', '=', $artist->pivot->artist_id)
			                    ->where('musician_id', '=', $artist->pivot->musician_id)
			                    ->get();
			    foreach($lineups as $lineup){
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
	 * @return Response
	 */
	public function store()
	{
            $inputs = Input::only('first_name', 'last_name', 'stagename', 'lineups');
            $validate = Musician::validate($inputs, Musician::$create_rules);
            if($validate === true) {
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
	public function update($id)
	{
            $inputs = Input::only('first_name', 'last_name', 'stagename');
            $validate = Musician::validate($inputs, Musician::$update_rules);
            if($validate === true) {
                $response = self::modify('Musician', $id, $inputs);
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
	public function destroy($id)
	{
            return Jsend::compile(self::delete('Musician', $id));
	}

        /**
         * Method checks possibility of an artist and instrument combination,
         * merge equal combinations to one and reset the input['lineups'] with
         * the result. Impossible results are ignored.
         * If there is no valid lineup set, the method returns a 'fail' response
         * and doesn't start the creation of the musician.
         */
        public static function save($inputs) {
            $existingLineups = array();
            foreach($inputs['lineups'] as $lineup) {
                if(Instrument::exist($lineup['instrument_id']) && Artist::exist($lineup['artist_id']) && !in_array($lineup, $existingLineups)) {
                    $existingLineups[] = $lineup;
                }
            }
            if(!count($existingLineups) > 0) {
                $response['fail'] = ['title' => trans('fail.musician.nolineup')];
            } else {
                $inputs['lineups'] = $existingLineups;
                $response = Musician::createOne($inputs);
            }
            return $response;    
        }

}
