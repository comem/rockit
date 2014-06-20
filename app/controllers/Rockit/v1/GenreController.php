<?php

namespace Rockit\v1;

use \Input;
use \Validator;
use \Genre
use \Jsend

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
		$data = Input::only('name');

		if(Genre::validate($data)){
			// check trash
			$trashedObject = Genre::onlyTrashed()->where('name_de', $data))->get();
			if(exist($trashedObject->id)){
				Genre::restore($trashedObject->id);
			} else if ()
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function destroy($id)
	{
		//
	}


}
