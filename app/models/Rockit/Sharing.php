<?php

namespace Rockit;

/**
 * Contains the attributes and methods of a Sharing model in the database.<br>
 * A Sharing is the relationship between a Platform and an Event that is published on that Platform.<br>
 * Based on the Laravel's Eloquent.<br>
 * 
 * @author generated with Laravel Schema Designer <laravelsd.com>
 */
class Sharing extends \Eloquent {

	protected $table = 'sharings';
	protected $hidden = ['external_id', 'external_infos', 'platform_id', 'event_id'];

	/**
     * Indicates whether this model uses laravel's timestamps.
     * @var boolean 
     */
	public $timestamps = true;

	/**
     * Get the Platform to which a Sharing is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
	public function platform()
	{
		return $this->belongsTo('Rockit\Platform');
	}

	/**
     * Get the Event to which a Sharing is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
	public function event()
	{
		return $this->belongsTo('Rockit\Event');
	}

}