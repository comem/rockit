<?php

namespace Rockit;

/**
 * Contains the attributes of the relationship between a Group and a Resource that it can act on.<br>
 * Based on the Laravel's Eloquent.<br>
 * 
 * @author ??
 */
class GroupResource extends \Eloquent {

	protected $table = 'group_resource';

	/**
     * Indicates whether this model uses laravel's timestamps.
     * @var boolean 
     */
	public $timestamps = false;

}