<?php

namespace Rockit\v1;

use \Input, \Validator, \Rockit\Image, \Jsend;

class GuaranteeController extends \BaseController {

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$inputs = Input::only('representer_id', 'event_id');
		$v = Validator::make(
		    $inputs,
		    ['representer_id' => 'required|exists:representers,id',
		    'event_id' => 'required|exists:events,id']
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
		//
	}


	public static function save( $inputs )
	{
		$event = Event::find( $inputs['event_id'] );
		if ( empty( $event->representer_id ) )
		{
			$update = Event::updateOne(['representer_id' => $inputs['representer_id']], $event);
			if ( isset( $update['success'] ) )
			{
				$response['success'] = [
					'title' => trans('success.guarantee.created'),
					'id' => $event->id,
				];
			}
			else
			{
				$response['error'] = [
					'title' => trans('error.guarantee.created')
				];
			}
		}
		else
		{
			$response['fail'] = [
				'title' =>  trans('fail.guarantee.existing')
			];
		}
		return $response;
	}


}
