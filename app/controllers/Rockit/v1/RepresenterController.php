<?php

namespace Rockit\v1;

use \Input,
    \Validator,
    Rockit\Representer;

class RepresenterController extends \BaseController {

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
            $data = Input::only('first_name', 'last_name', 'email', 'phone', 'street', 'npa', 'city');
            $v = Validator::make($data, Representer::$create_rules);
            if ($v->fails()) {
                return $v->messages()->getMessages();
            }
            return "OK";
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
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


}
