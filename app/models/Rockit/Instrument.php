<?php

namespace Rockit;

use \Validator;

class Instrument extends \Eloquent {

	protected $table = 'instruments';
	public $timestamps = false;

	public function lineups()
	{
		return $this->hasMany('Rockit\Lineup');
	}
        
        public static $create_rules = array(
		'name_de' => 'alpha|required|min:1',
	);

	public static $update_rules = array(
		'name_de' => 'alpha|required|min:1',
	);

	public static function exist( $name )
	{
		$response = self::where('name_de', '=', $name)->first();
		if($response == NULL){
			$response['fail'] = trans('fail.instrument.inexistant');
		}
		return $response;
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

	public static function createOne( $inputs )
	{
		self::unguard();
		$object = self::create( $inputs );
		if( $object != null ){
			$response['success'] = array(
				'title' => trans('success.instrument.created'),
				'id' => $object->id,
			);
		} else {
			$response['error'] = trans('error.instrument.created');
		}
		return $response;
	}

	public static function updateOne( $new_values, Instrument $object )
	{
		foreach( $new_values as $key => $value )
		{
			$object->$key = $value;
		}
		if( $object->save() ){ 
			$response['success'] = array(
				'title' => trans('success.instrument.updated'),
			);
		} else {
			$response['error'] = trans('error.instrument.updated');
		}
		return $response;
	}

	public static function deleteOne(Instrument $object )
	{
		if( $object->delete() ){ 
			$response['success'] = array(
				'title' => trans('success.instrument.deleted'),
			);
		} else {
			$response['error'] = trans('error.linstrument.deleted');
		}
		return $response;
	}

	public static function restoreOne(Instrument $object )
	{
		if( $object->restore() ){ 
			$response['success'] = array(
				'title' => trans('success.instrument.restored'),
			);
		} else {
			$response['error'] = trans('error.instrument.restored');
		}
		return $response;
	}

}