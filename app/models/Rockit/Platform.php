<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

/**
 * Contains the attributes and methods of a Platform model in the database.<br>
 * An Event can be published on a Platform.<br>
 * Based on the Laravel's Eloquent.<br>
 * 
 * @author generated with Laravel Schema Designer <laravelsd.com>
 */
class Platform extends \Eloquent {

	use SoftDeletingTrait;

	protected $table = 'platforms';
	protected $hidden = ['client_id', 'client_secret', 'api_infos', 'deleted_at'];
	protected $dates = ['deleted_at'];

	/**
     * Indicates whether this model uses laravel's timestamps.
     * @var boolean 
     */
	public $timestamps = false;

	/**
     * Get the Events to which a Platform is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
	public function events()
	{
		return $this->belongsToMany('Rockit\Event')->withPivot('url');
	}

}