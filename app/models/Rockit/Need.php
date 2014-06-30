<?php

namespace Rockit;

use Rockit\Models\CompletePivotModelTrait;

/**
 * Contains the attributes and methods of a Need model.<br>
 * A Need is the relationship between an Event and a Skill that is needed for that Event.<br>
 * Based on the Laravel's Eloquent.<br>
 * 
 * @author ??
 */
class Need extends \Eloquent {

	use CompletePivotModelTrait;

	protected $table = 'needs';
	protected $hidden = ['skill_id', 'event_id'];

	/**
     * Indicates whether this model uses laravel's timestamps.
     * @var boolean 
     */
	public $timestamps = false;

	/**
     * Indicates which field value should be used in the return messages.
     * @var string 
     */
	public static $response_field = 'id';

	/**
     * Validations rules for creating a new Need.
     * @var array 
     */
	public static $create_rules = [
		'nb_people' 	=> 'integer|required|min:1',
		'event_id' 		=> 'integer|required|min:1|exists:events,id',
		'skill_id' 		=> 'integer|required|min:1|exists:skills,id',
	];

	/**
     * Validation rules for updating an existing Need.
     * @var array 
     */
	public static $update_rules = [
		'nb_people' 	=> 'integer|min:1',
	];

	/**
     * Get the Skill to which a Need is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
	public function skill()
	{
		return $this->belongsTo('Rockit\Skill');
	}

	/**
     * Get the Event to which a Need is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
	public function event()
	{
		return $this->belongsTo('Rockit\Event');
	}

}
