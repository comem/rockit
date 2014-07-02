<?php

namespace Rockit\Models;

use Rockit\Traits\Models\SimplePivotModelTrait;

/**
 * Contains the attributes and methods of a Lineup model.<br>
 * A Lineup is the relationship between an Artist, a Musician that composes that Artist and the Instruments played by that Musician for that Artist.<br>
 * Based on the Laravel's Eloquent.<br>
 * 
 * @author generated with Laravel Schema Designer <laravelsd.com>
 * @author Joël Gugger <joel.gugger@heig-vd.ch>
 */
class Lineup extends \Eloquent {

    use SimplePivotModelTrait;

    protected $table = 'lineups';

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
     * Validations rules for creating a new Lineup.
     * @var array 
     */
    public static $create_rules = [
        'musician_id' => 'integer|required|min:1|exists:musicians,id',
        'instrument_id' => 'integer|required|min:1|exists:instruments,id',
        'artist_id' => 'integer|required|min:1|exists:artists,id',
    ];

    /**
     * Get the Instruments to which a Lineup is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function instrument() {
        return $this->belongsTo('Rockit\Models\Instrument')->withTrashed();
    }

    /**
     * Get the Artist to which a Lineup is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function artist() {
        return $this->belongsTo('Rockit\Models\Artist')->withTrashed();
    }

    /**
     * Get the Musicians to which a Lineup is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function musician() {
        return $this->belongsTo('Rockit\Models\Musician')->withTrashed();
    }

    /**
     * Check if the Musician corresponding to the provided musician id has only one, last Lineup.
     *
     * If this is the last Lineup for the Musician corresponding to the provided musician id, a <b>Jsend:fail</b> is returned.<br>
     * Or else a boolean 'false' is returned.<br>
     * 
     * @return a boolean 'false' or a Jsend:fail message
     */
    public static function isLastLineup($object) {
        $response = false;
        $lineup = Lineup::where('musician_id', '=', $object->musician_id)->count();
        if ($lineup < 2) {
            $response = array(
                'fail' => array(
                    'title' => trans('fail.lineup.last_lineup'),
                ),
            );
        }
        return $response;
    }

}
