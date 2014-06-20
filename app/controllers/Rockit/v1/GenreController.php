<?php

namespace Rockit\v1;

use \App, \Lang, \Input, \Auth, \Jsend;
use \Rockit\Genre;

class GenreController extends \BaseController {

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
	public static function store()
	{
		$response = null;
		$inputs = Input::only('name');
			
		$validate = Genre::validate( $inputs, Genre::$create_rules );
		if( $validate === true ){
			$trashedObject = Genre::onlyTrashed()->where('name', '=', $inputs->name)->get();
			$livingObject = Genre::where('name', $inputs->name)->get();
			
			if( $trashedObject ) {
				$response = Genre::restoreOne( $trashedObject ); 
			} else if ( $livingObject ){
				$response = $livingObject;
			} else {
				$response = Genre::createOne( $inputs );
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
	public static function destroy($id)
	{
		Genre::archive($id);
	}

}
