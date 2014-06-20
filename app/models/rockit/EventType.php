<?php

name_despace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class EventType extends \Eloquent {

	protected $table = 'event_types';
	public $timestamps = false;
	protected $dates = ['deleted_at'];

	use SoftDeletingTrait;

	public static $create_rules = array(
		'id' => 'integer|min:1|required',
        'name_de' => 'required|alpha_num|min:1',
		);

	public function events()
	{
		return $this->hasMany('Rockit\Event');
	}

	public static function exist( $inputs )
	{
		$response = null;
		if( is_integer($inputs) ){
			$response = self::where('id', '=', $inputs)->first();
		} else if( is_string($inputs) ){
			$response = self::where('name_de', '=', $name)->first();
		}
		if( $response = null ){
			$response['fail'] = trans('fail.event_type.inexistant'); 
		}
		return $response;
	}

	public static function createOne( $inputs )
	{
		self::unguard();
		$object = self::create( $inputs );
		if ( $object != null ){
			$response['success'] = array(
				"title" => trans('success.event_type.created'),
				"id" => $object->id,
				);
		} else {
			$response['error'] = trans('error.event_type.created');
		}
		return Jsend::compile($response);
		// return $response; 
	}

	public static function restoreOne( EventType $object )
	{
		if( $object->restore() ){
			
		}
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

}