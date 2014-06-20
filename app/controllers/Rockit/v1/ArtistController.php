<?php

namespace Rockit\v1;

use \Rockit\Artist,
        \Jsend,
        \Input;


class ArtistController extends \BaseController {

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
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
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
            $inputs = Input::only('name', 'short_description_de', 'complete_description_de', 'genres');
            $validate = Artist::validate($inputs, Artist::$create_rules);
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
		//
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
        
        public static function save($inputs) {
            $existingMergedGenres = array();
            foreach ($inputs['genre'] as $genre_id) {
                if(Genre::exists($genre_id)) {
                    if();
                    $existingMergedGenres[] = $genre_id;
                }
            }
            
            
            Artist::createOne($inputs);
            return $response;
        }

}
