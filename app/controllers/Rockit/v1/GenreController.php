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
	public function store()
	{
		$response = null;
		$inputs = Input::only('name_de');

		$validate = Genre::validate( $inputs, Genre::$create_rules );
		
		if( $validate === true ){
		// 	$response = renew($inputs['name_de']);
		
		//if not trashed...
		$response = self::save( $inputs );
		} else {
			$response = $validate;
		}
		return $response;
		// return Jsend::compile($response);
	}

	public static function save( $inputs ){

		$genre = Genre::exist( $inputs );
		if(is_object($genre)){
			$response = $genre;
		} else {
			$response = Genre::createOne( $inputs );
		}
		return $response;
	}


	public static function renew( $name )
	{
		$response = false;
		$trashedObject = Genre::onlyTrashed()->where('name_de', '=', $inputs['name_de'])->get();
		if( $trashedObject != null){
			$response = Genre::restoreOne($trashedObject['name_de']);
		} 
		return false;
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
