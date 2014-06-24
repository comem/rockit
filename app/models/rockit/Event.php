<?php

namespace Rockit;

use \Validator, \DB;

class Event extends \Eloquent {
    
        use RockitModelTrait;

	protected $table = 'events';
	public $timestamps = true;

        /**
         *
         * @var array 
         */
	public static $create_rules = array(
		'start_date_hour' 		=> 'date|required',
		'ending_date_hour' 		=> 'date|required',
		'opening_doors' 		=> 'date',
		'title_de' 				=> 'required|min:2',
		'nb_meal' 				=> 'integer|required',
		'nb_vegans_meal' 		=> 'integer|required',
		'meal_notes_de' 		=> '',
		'nb_places'	 			=> 'integer|min:0',
		'followed_by_private' 	=> 'boolean',
		'notes_de' 				=> '',
	);

	public static $update_rules = array(
		'start_date_hour' 		=> 'date',
		'ending_date_hour' 		=> 'date',
		'opening_doors' 		=> 'date',
		'title_de' 				=> 'min:2',
		'nb_meal' 				=> 'integer',
		'nb_vegans_meal' 		=> 'integer',
		'meal_notes_de' 		=> '',
		'nb_places'	 			=> 'integer|min:0',
		'followed_by_private' 	=> 'boolean',
		'notes_de' 				=> '',
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
//
//	/**
//	* Validate the information passed in parameters
//	*
//	* @param $inputs, $rules
//	* @return true or fail message
//	*/
//	public static function validate( $inputs, $rules )
//	{
//		$v = Validator::make( $inputs, $rules );
//		if( $v->fails() ){
//			$response['fail'] = $v->messages()->getMessages();
//		} else {
//			$response = true;
//		}
//		return $response;
//	}

	/**
	* Check that anEventStartDateHour is set after anEventOpeningDoors
	*
	* @param $start_date_hour, $opening_doors_hour
	* @return  true or fail message
	*/
	public static function checkOpeningDoorsHour( $start_date_hour, $opening_doors_hour )
	{
		$v = Validator::make(
		    array('start_date_hour' => $start_date_hour),
		    array('start_date_hour' => 'required|after:'.$opening_doors_hour)
		);
		if( $v->fails() ){
			$response['fail'] = $v->messages()->getMessages();
		} else {
			$response = true;
		}
		return $response;
	}

	/**
	* Check that anEventStartDateHour is set before anEventEndingDateHour
	*
	* @param $start_date_hour, $ending_date_hour
	* @return  true or fail message
	*/
	public static function checkDatesChronological( $start_date_hour, $ending_date_hour )
	{
		$v = Validator::make(
		    array('start_date_hour' => $start_date_hour),
		    array('start_date_hour' => 'required|before:'.$ending_date_hour)
		);
		if( $v->fails() ){
			$response['fail'] = $v->messages()->getMessages();
		} else {
			$response = true;
		}
		return $response;
	}

	/**
	* Check that the interval between anEventStartDateHour and 
	* anEventEndingHour does not overlap with another Event
	*
	* IF ((any persisting Events have a start_date_hour OR an ending_date_hour 
	* BETWEEN aChonologicalStart AND aChronologicalEnding) OR 
	* (any persisting Events have a start_date_hour which is smaller 
	* than aChronologicalStart AND has an ending_date_hour which is 
	* greater than aChronologicalEnding)),THEN generate eventsOverlapping, 
	* ELSE generate :- aNonOverlappingStart that matches the received 
	* aChronologicalStart,- aNonOverlappingEnding that matches the received 
	* aChronologicalEnding
	*
	* @param $start_date_hour, $ending_date_hour
	* @return  true or fail message
	*/
	public static function checkDatesDontOverlap( $start_date_hour, $ending_date_hour )
	{
		$results = DB::select(
			'SELECT * FROM events 
			WHERE ( start_date_hour BETWEEN ? AND ? OR
			ending_date_hour BETWEEN ? AND ? ) OR
			( start_date_hour < ? AND ending_date_hour > ? )', 
			array(
				$start_date_hour, $ending_date_hour,
				$start_date_hour, $ending_date_hour,
				$start_date_hour, $ending_date_hour,
			));
		if($results != NULL){
			$response['fail'] = array(
				'title' => trans('fail.event.overlap'),
			);
		} else {
			$response = true;
		}
		return $response;
	}

	/**
	* Create a new Event
	*
	* @param $inputs
	* @return  true or error message
	*/
//	public static function createOne( $inputs )
//	{
//		self::unguard();
//		$object = self::create( $inputs );
//		if( $object != null ){
//			$response['success'] = array(
//				'title' => trans('success.event.created'),
//				'id' => $object->id,
//			);
//		} else {
//			$response['error'] = trans('error.event.created');
//		}
//		return $response;
//	}

	/**
	* Update a persistant Event, based on the difference between a 
	* provided anEventToModify and anExistingEvent
	*
	* @param $new_values, Event $object
	* @return  true or error message
	*/
//	public static function updateOne( $new_values, Event $object )
//	{
//		foreach( $new_values as $key => $value )
//		{
//			$object->$key = $value;
//		}
//		if( $object->save() ){ 
//			$response['success'] = array(
//				'title' => trans('success.event.updated'),
//			);
//		} else {
//			$response['error'] = trans('error.event.updated');
//		}
//		return $response;
//	}

	/**
	* Delete a persistant Event
	*
	* @param Event $object
	* @return  true or error message
	*/
//	public static function deleteOne( Event $object )
//	{
//		if( $object->delete() ){ 
//			$response['success'] = array(
//				'title' => trans('success.event.deleted'),
//			);
//		} else {
//			$response['error'] = trans('error.event.deleted');
//		}
//		return $response;
//	}

}
