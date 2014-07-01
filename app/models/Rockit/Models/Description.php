<?php

namespace Rockit\Models;

use Rockit\Traits\Models\SimplePivotModelTrait;

/**
 * Contains the attributes and methods of a Description model.<br>
 * A Description is the relationship between an Artist and a Genre that describes that Artist.<br>
 * Based on the Laravel's Eloquent.<br>
 * 
 * @author generated with Laravel Schema Designer <laravelsd.com>
 * @author Joël Gugger <joel.gugger@heig-vd.ch>
 */
class Description extends \Eloquent {

    use SimplePivotModelTrait;

    protected $table = 'descriptions';

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
     * Validations rules for creating a new Description.
     * @var array 
     */
    public static $create_rules = [
        'genre_id' => 'integer|required|min:1|exists:genres,id',
        'artist_id' => 'integer|required|min:1|exists:artists,id',
    ];

    /**
     * Get the Artist to which a Description is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function artist() {
        return $this->belongsTo('Rockit\Models\Artist')->withTrashed();
    }

    /**
     * Get the Genre to which a Description is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function genre() {
        return $this->belongsTo('Rockit\Models\Genre')->withTrashed();
    }

    /**
     * Check if the Artist corresponding to the provided artist id is described by only one, last Genre.
     *
     * If this is the last Genre for the Artist corresponding to the provided artist id, a <b>Jsend:fail</b> is returned.<br> 
     * @return a boolean 'false' or a Jsend:fail message
     */
    public static function isLastGenre($object) {
        $response = false;
        $genres = self::where('artist_id', '=', $object->artist_id)->count();
        if ($genres < 2) {
            $response = array(
                'fail' => array(
                    'title' => trans('fail.description.last_genre'),
                ),
            );
        }
        return $response;
    }

}
