<?php

namespace Rockit\v1;

use \App, \Lang, \Input, \Auth, \Jsend;
use Rockit\Genre;

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
	public function store()
	{
		$inputs = Input::only('name_de');

		$response = Genre::validate( $inputs, Genre::$create_rules );
		
		if( $response === true ){
		
		
			$response = self::renew($inputs['name_de']);
			if( $response === false ) {
				$response = self::save( $inputs );
			}
		}
		return Jsend::compile($response);
	}

	public static function save( $inputs ){

		$genre = Genre::exist( $inputs );
		if(is_object($genre)){
			// $response = $genre;
			$reponse['error'] = trans('error.genre.existing');
		} else {
			$response = Genre::createOne( $inputs );
		}
		return $response;
	}


	public static function renew( $name )
	{
		$response = false;
		$trashedObject = Genre::onlyTrashed()->where('name_de', '=', $name)->get();
		if( is_object($trashedObject) ){
			$response = Genre::restoreOne( $trashedObject );
		} 
		return $response;
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy( $inputs )
	{
		$object = Genre::exist( $inputs );
		$response = Genre::deleteOne( $object );
		return $response;
	}

}
