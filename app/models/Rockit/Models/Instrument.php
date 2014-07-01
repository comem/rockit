<?php

namespace Rockit\Models;

use \Illuminate\Database\Eloquent\SoftDeletingTrait,
    Rockit\Traits\Models\ModelBCRDTrait;

/**
 * Contains the attributes and methods of an Instrument model in the database.<br>
 * An Instrument is played in a Lineup by a Musician.<br>
 * Based on the Laravel's Eloquent.<br>
 * 
 * @author generated with Laravel Schema Designer <laravelsd.com>
 */
class Instrument extends \Eloquent {

    use SoftDeletingTrait,
        ModelBCRDTrait;

    protected $table = 'instruments';
    protected $dates = ['deleted_at'];
    protected $hidden = ['deleted_at'];

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
        return $this->hasMany('Rockit\Models\Lineup');
    }

}
