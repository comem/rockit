<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait,
    Rockit\Models\ModelBCRDTrait;

/**
 * Contains the attributes and methods of a Genre model in the database.<br>
 * A Genre describes an Artist, and each Artist is described by atleast one Genre.<br>
 * Based on the Laravel's Eloquent.<br>
 * 
 * @author generated with Laravel Schema Designer <laravelsd.com>
 * @author Christopher de Guzman <christopher.deguzman@heig-vd.ch>
 */
class Genre extends \Eloquent {

    use SoftDeletingTrait,
        ModelBCRDTrait;

    protected $table = 'genres';
    protected $dates = ['deleted_at'];
    protected $hidden = ['deleted_at', 'pivot'];

    /**
     * Indicates whether this model uses laravel's timestamps.
     * @var boolean 
     */
    public $timestamps = false;

    /**
     * Indicates which field value should be used in the return messages.
     * @var string 
     */
    public static $response_field = 'name_de';

    /**
     * Validations rules for creating a new Genre.
     * @var array 
     */
    public static $create_rules = array(
        'name_de' => 'required',
    );

    /**
     * Get the Artists to which a Genre is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function artists() {
        return $this->belongsToMany('Rockit\Artist', 'descriptions', 'genre_id', 'artist_id');
    }

    public function events() {
        return $this->belongsToMany('Rockit\Genre', 'event_genre');
    }

    /**
     * Merge the Genres provided to return a list of unique Genres.
     * @return array A list of unique Genres
     */
    public static function mergeGenres(array $genresToMerge) {
        return array_unique($genresToMerge);
    }

}
