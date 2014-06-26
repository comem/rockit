<?php

namespace Rockit\v1;

use \Input, \Validator;

class IllustrationController extends \BaseController {


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$inputs = Input::only('artist_id', 'image_id');
		$v = Validator::make(
		    $inputs,
		    ['artist_id' = 'required|exists:artists,id',
		    'image_id' = 'required|exists:images,id']
		);
		if($v->passes()){
			$response = self::save( $inputs );
		} else {
			$response['fail'] = $v->messages()->getMessages();
		}
		return Jsend::success($response);
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
