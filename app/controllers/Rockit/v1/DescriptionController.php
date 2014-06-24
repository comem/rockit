<?php

namespace Rockit\v1;

use \Input,
    \Jsend,
    \Rockit\Description,
	Rockit\Controllers\SimplePivotControllerTrait;

class DescriptionController extends \BaseController {

	use SimplePivotControllerTrait;

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::only('genre_id', 'artist_id');
		$response = Description::validate($data, Description::$create_rules);
        if ($response === true) {
            $response = self::save('Description', $data);
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
		return Jsend::compile(self::delete($id));
	}

	/**
     * 
     * @param 
     * @param 
     */
    public static function delete($id) {
        $object = Description::exist($id);
        if ($object == null) {
            $response = array(
                'fail' => array(
                    'title' => trans('fail.description.inexistant'),
                ),
            );
        } else {
        	$response = Description::isLastGenre($object);
        	if($response === false){
        		$response = Description::deleteOne($object);
        	}
        }
        return $response;
    }


}
