<?php

namespace Rockit\Models;

use Rockit\Traits\Models\ModelBCUDTrait;

/**
 * Contains the attributes and methods of a Link model in the database.<br>
 * A Link is possessed by an Artist. An Artist is not obliged to possess a Link, and can possess multiple Links.<br>
 * A Link is used to register information concerning a weblink to the Artist's media.<br>
 * Based on the Laravel's Eloquent.<br>
 * 
 * @author generated with Laravel Schema Designer <laravelsd.com>
 */
class Link extends \Eloquent {

    use ModelBCUDTrait;

    protected $table = 'links';
    protected $hidden = ['artist_id'];

    /**
     * Indicates whether this model uses laravel's timestamps.
     * @var boolean 
     */
    public $timestamps = false;

    /**
     * Indicates which field value should be used in the return messages.
     * @var string 
     */
    public static $response_field = 'url';

    /**
     * Validation rules for creating a new Link.
     * @var array 
     */
    public static $create_rules = array(
        'url' => 'required|url|max:400|unique:links',
        'name_de' => 'required|max:200',
        'title_de' => 'max:50',
        'artist_id' => 'required|integer|exists:artists,id',
    );

    /**
     * Validation rules for updating an existing Link.
     * @var array 
     */
    public static $update_rules = array(
        'url' => 'url|max:400|unique:links',
        'name_de' => 'max:200',
        'title_de' => 'max:50',
    );

    /**
     * Get the Artist to which a Link is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function artist() {
        return $this->belongsTo('Rockit\Models\Artist')->withTrashed();
    }

}
