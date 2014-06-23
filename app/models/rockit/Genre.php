<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use \Validator;

class Genre extends \Eloquent {

	use SoftDeletingTrait;

	protected $table = 'genres';
	public $timestamps = false;
	protected $dates = array('deleted_at');

	public static $create_rules = array(
        'name_de' => 'required|min:1',
		);

	public function artists()
	{
		return $this->belongsToMany('Rockit\Artist');
	}

	public static function exist( $inputs )
	{	
		$response = null;
		if(isset($inputs['id']) && is_integer($inputs['id']) ){
			$response = self::where('id', '=', $inputs['id'])->first();
		} else {
        	$response = self::where('name_de', '=', $inputs['name_de'])->first();
		}
		if( $response == null ){
        	$response['fail'] = trans('fail.genre.inexistant');
        }
        return $response;
	} 

	public static function createOne( $inputs )
	{
		self::unguard();
		$object = self::create( $inputs );
		if( $object != null ){
			$response['success'] = array(
				'title' => trans('success.genre.created'),
				'id' => $object->id,
				);
		} else {
			$response['error'] = trans('error.genre.created');
		}
		return Jsend::compile($response);
		// return $response;
    }

    public static function validate( $inputs, $rules )
	{ 
        $v = Validator::make( $inputs, $rules );
        if( $v->fails() ){
            $response['fail'] = $v->messages()->getMessages();
        } else {
            $response = true;
        }
        return $response;
	}

	public static function merge($data)
	{
		foreach ($data as $genre){
			//
		}
	}

	public static function deleteOne( Genre $object )
	{
		if( $object->delete() ){
			$response['success'] = array(
				'title' => trans('success.genre.deleted'),
			);
		} else {
			$response['error'] = trans('error.genre.deleted');
		}
		return $response;
	}

	public static function restoreOne( Genre $object )
	{
		if( $object->restore() ){
			$response['success'] = array(
				'title' => trans('success.genre.restored'),
			);
		} else {
			$response['error'] = trans('error.genre.restored');
		}
		return $response;
	}


}