<?php

namespace Rockit;

class Event extends \Eloquent {

	protected $table = 'events';
	public $timestamps = true;

	public static $create_rules = array(
		'start_date_hour' 		=> 'date|required',
		'ending_date_hour' 		=> 'date|required',
		'opening_doors' 		=> 'date',
		'title_de' 				=> 'alpha|required|min:2',
		'nb_meal' 				=> 'integer|required',
		'nb_vegans_meal' 		=> 'integer|required',
		'meal_notes_de' 		=> 'alpha_num',
		'nb_places'	 			=> 'integer|min:0',
		'followed_by_private' 	=> 'boolean',
		'notes_de' 				=> 'alpha_num',
	);

	public static $update_rules = array(
	);

	public function gifts()
	{
		return $this->belongsToMany('Rockit\Gift')->withPivot('quantity','cost','comment_de');
	}

	public function ticketCategories()
	{
		return $this->belongsToMany('Rockit\TicketCategory')->withPivot('ammount','comment_de','quantity_sold');
	}

	public function equipments()
	{
		return $this->belongsToMany('Rockit\Equipment')->withPivot('quantity','cost');
	}

	public function platforms()
	{
		return $this->belongsToMany('Rockit\Platform')->withPivot('url');
	}

	public function printingTypes()
	{
		return $this->belongsToMany('Rockit\PrintingType')->withPivot('source','nb_copies','nb_copies_surplus');
	}

	public function eventTypes()
	{
		return $this->belongsToMany('Rockit\EventType');
	}

	public function artists()
	{
		return $this->belongsToMany('Rockit\Artist')->withPivot('order','is_support','artist_hour_of_arrival');
	}

	public function members()
	{
		return $this->belongsToMany('Rockit\Member');
	}

	public function skills()
	{
		return $this->belongsToMany('Rockit\Skill')->withPivot('nb_people');
	}

	public function representer()
	{
		return $this->belongsTo('Rockit\Representer');
	}
	

	/**
	* Check that there is an event that exists in the set of persistant Events, 
	* based on a provided id
	*
	* @param $id
	* @return true or fail message
	*/
	public static function exist( $id )
	{
		$response = self::where('id', '=', $id)->first();
		if($response == NULL){
			$response['fail'] = trans('fail.event.inexistant');
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

	/**
	* Check that anEventStartDateHour is set after anEventOpeningDoors
	*
	* @param 
	* @return 
	*/
	public static function checkOpeningDoorsHour( $start_date_hour, $opening_doors_hour )
	{

	}

	/**
	* Check that anEventStartDateHour is set before anEventEndingDateHour
	*
	* @param 
	* @return 
	*/
	public static function checkDatesChronological( $start_date_hour, $ending_date_hour )
	{

	}

	/**
	* Check that the interval between anEventStartDateHour and 
	* anEventEndingHour does not overlap with another Event
	*
	* @param 
	* @return 
	*/
	public static function checkDatesDontOverlap( $start_date_hour, $ending_date_hour )
	{

	}

	public static function createOne( $inputs )
	{
		self::unguard();
		$object = self::create( $inputs );
		if( $object != null ){
			$response['success'] = array(
				'title' => trans('success.event.created'),
				'id' => $object->id,
			);
		} else {
			$response['error'] = trans('error.event.created');
		}
		return $response;
	}

	public static function updateOne( $new_values, Event $object )
	{
		foreach( $new_values as $key => $value )
		{
			$object->$key = $value;
		}
		if( $object->save() ){ 
			$response['success'] = array(
				'title' => trans('success.event.updated'),
			);
		} else {
			$response['error'] = trans('error.event.updated');
		}
		return $response;
	}

	public static function deleteOne( Event $object )
	{
		if( $object->delete() ){ 
			$response['success'] = array(
				'title' => trans('success.event.deleted'),
			);
		} else {
			$response['error'] = trans('error.event.deleted');
		}
		return $response;
	}

}
