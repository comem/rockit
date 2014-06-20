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
		return Genre::all();
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
			// check trashed genres
			$trashedObject = Genre::onlyTrashed()->where('name_de', $data->name))->get();
			// check living genres
			$livingObject = Genre::where('name_de', $data->name))->get();
			if($trashedObject){
				return Genre::restore($trashedObject->id);
			} else if (exist($livingObject->id)){
				return $livingObject;
			} else {
				return Genre::create($data);
			}
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
		Genre::archive($id);
	}


}
