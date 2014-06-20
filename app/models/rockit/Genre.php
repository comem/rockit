<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Genre extends \Eloquent {

	protected $table = 'genres';
	public $timestamps = false;
	protected $dates = array('deleted_at');

	public static $rules = array(
		'id' => 'integer|min:1|required',
        'name' => 'required|alpha_num|min:2',
		);

	public function artists()
	{
		return $this->belongsToMany('Rockit\Artist');
	}

	public static function exist( $id )
	{
        $response = self::where('id', '=', $locale)->first();
        if($response == NULL){
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
		return $response;
    }

    public static function validate( $inputs, $rules )
	{ 
        $v = Validator::make( $inputs, $rules );
        if ( $v->fails() ){
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
			)
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