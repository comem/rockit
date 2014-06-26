<?php

namespace Rockit\v1;

use \Input, \Validator, \Rockit\Image, \Jsend;

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
		    ['artist_id' => 'required|exists:artists,id',
		    'image_id' => 'required|exists:images,id']
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


	public static function save( $inputs )
	{
		$image = Image::find( $inputs['image_id'] );
		if ( empty( $image->artist_id ) )
		{
			$update = Image::updateOne(['artist_id' => $inputs['artist_id']], $image);
			if ( isset( $update['success'] ) )
			{
				$response['success'] = [
					'title' => trans('success.illustration.created'),
					'id' => $image->id,
				];
			}
			else
			{
				$response['error'] = [
					'title' => trans('error.illustration.created')
				];
			}
		}
		else
		{
			$response['fail'] = [
				'title' =>  trans('fail.illustration.existing')
			];
		}
		return $response;
	}


}
