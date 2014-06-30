<?php

namespace Rockit;

/**
 * Contains the attributes and methods of an Instrument model in the database.<br>
 * An Instrument is played in a Lineup by a Musician.<br>
 * Based on the Laravel's Eloquent.<br>
 * 
 * @author ??
 */
class Instrument extends \Eloquent {

    use \Illuminate\Database\Eloquent\SoftDeletingTrait,
        Models\ModelBCRDTrait;

    protected $table = 'instruments';

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
     * Validations rules for creating a new Instrument.
     * @var array 
     */
    public static $create_rules = array(
        'name_de' => 'required|min:1',
    );

    /**
     * Get the Lineups to which an Instrument is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function lineups() {
        return $this->hasMany('Rockit\Lineup');
    }

}
