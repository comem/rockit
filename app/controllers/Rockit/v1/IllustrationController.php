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
		$image = Image::exist( $id );
		if( is_object( $image ) ){
			$response = self::delete( $image );
		} else {
			$response['fail'] = [
				'title' => trans('fail.image.inexistant'),
			];
		}
		return Jsend::compile($response);
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


	public static function delete( $image )
	{
		if ( empty( $image->artist_id ) )
		{
			$response['fail'] = [
				'title' =>  trans('fail.illustration.inexistant')
			];
		}
		else
		{
			$image->artist_id = NULL;
			if ( $image->save() )
			{
				$response['success'] = [
					'title' => trans('success.illustration.deleted'),
				];
			}
			else
			{
				$response['error'] = [
					'title' => trans('error.illustration.deleted')
				];
			}
		}
		return $response;
	}


}
