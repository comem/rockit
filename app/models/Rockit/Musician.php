<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait,
    \DB,
    Rockit\Lineup;

/**
 * Contains the attributes and methods of a Musician model in the database.<br>
 * A Musician composes atleast one Artist. A Musician cannot perform in an Event. Only an Artist can become a Performer for an Event.<br>
 * Based on the Laravel's Eloquent.<br>
 * 
 * @author generated with Laravel Schema Designer <laravelsd.com>
 * @author Christian Heimann <christian.heimann@heig-vd.ch>
 */
class Musician extends \Eloquent {

    use Models\ModelBCUDTrait,
        SoftDeletingTrait;

    protected $table = 'musicians';
    protected $dates = ['deleted_at'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Indicates whether this model uses laravel's timestamps.
     * @var boolean 
     */
    public $timestamps = true;

    /**
     * Indicates which field value should be used in the return messages.
     * @var string 
     */
    public static $response_field = 'first_name';

    /**
     * Validation rules for creating a new Musician.
     * @var array 
     */
    public static $create_rules = array(
        'first_name' => 'required|min:1|max:100|names',
        'last_name' => 'max:100|names',
        'stagename' => 'max:100',
        'lineups' => 'required|array|min:1',
    );

    /**
     * Validation rules for updating an existing Musician.
     * @var array 
     */
    public static $update_rules = array(
        'first_name' => 'min:1|max:100|names',
        'last_name' => 'max:100|names',
        'stagename' => 'max:100',
    );

    /**
     * Get the Lineups to which a Musician is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function lineups() {
        return $this->hasMany('Rockit\Lineup');
    }

    /**
     * Get the Instruments that a Musician plays for a specific Artist, corresponding to the provided artist id.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function instrumentsFor($artist_id) {
        return $this->belongsToMany('Rockit\Instrument', 'lineups')->withTrashed()->where('artist_id', '=', $artist_id);
    }

    /**
     * Get the Instruments to which a Musician is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function instruments() {
        return $this->belongsToMany('Rockit\Instrument', 'lineups')->withTrashed();
    }

    /**
     * Get the Artists to which a Musician is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function artists() {
        return $this->belongsToMany('Rockit\Artist', 'lineups')->groupBy('id')->withTrashed();
    }

    /**
     * Create and save in the database a new Model with the provided data.
     * 
     * Create the Musician first, and then proceed to create the relationships between this newly created Musician and the given Models ids.
     * 
     * @param array $data The data for the Model to create
     * @return array An array containing a key 'success' or 'error' depending on the result
     */
    public static function createOne($data) {
        $field = self::$response_field;
        self::unguard();
        DB::beginTransaction();
        $lineups = $data['lineups'];
        unset($data['lineups']); // to put data into create() function for musician
        $object = self::create($data);
        if ($object != null) {
            foreach ($lineups as $lineup) {
                $lineup['musician_id'] = $object->id;
                $objectLineup = Lineup::create($lineup);
                // if a lineup object is not created correctly, return response error message
                if ($objectLineup == null) {
                    $response['error'] = trans('error.lineup.created');
                    DB::rollback();
                    return $response;
                }
            }
            $response['success'] = array(
                'title' => trans('success.musician.created', array('name' => $object->$field)),
                'id' => $object->id,
            );
            DB::commit();
        } else {
            $response['error'] = trans('error.musician.created', array('name' => $object->$field));
            DB::rollback();
        }
        return $response;
    }

}
