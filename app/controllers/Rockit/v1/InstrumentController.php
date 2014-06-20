<?php

namespace Rockit\v1;

use Rockit\Instrument;

use \App, \Lang, \Input, \Auth, \Jsend;

class InstrumentController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		 return  \Jsend::success(\Rockit\Instrument::all()->toArray());
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$inputs = Input::only('name_de');
		$validate = Instrument::validate( $inputs, Instrument::$create_rules );
		if( $validate === true ){
			$response = self::setLocale( $inputs['name_de'] );
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
		$name_de = Instrument::exist( $id );
		if( is_object( $name_de ) ) {
			/*
			Lang::where()
			$user = Auth::user();
			$user->language_id = 0;
			*/
			//$response['success'] = $lang;
			$response = Instrument::deleteOne(
				$name_de
			);

			return $response;

			//return $lang;
		} else {
			return $name_de;
		}
	}


}
