<?php

namespace Rockit\v1;

class EventTypeController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$response = null;
		$inputs = Input::only('name_de');
			
		$validate = EventType::validate( $inputs, EventType::$create_rules );
		if( $validate === true ){
			$trashedObject = EventType::onlyTrashed()->where('name_de', '=', $inputs->name_de)->get();
			$livingObject = EventType::where('name_de', $inputs->name_de)->get();
			
			if( $trashedObject ) {
				$response = EventType::restoreOne( $trashedObject ); 
			} else if ( $livingObject ){
				$response = $livingObject;
			} else {
				$response = EventType::createOne( $inputs );
			}
		}
		return $response;
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
