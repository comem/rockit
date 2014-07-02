<?php

namespace Rockit\Models;

use Rockit\Traits\Models\ModelBCUDTrait,
    Rockit\Traits\Models\Functions\RestoreOneTrait;

/**
 * Contains the attributes and methods of a Language model in the database.<br>
 * A Language can be the default language of a User.<br>
 * Based on the Laravel's Eloquent.<br>
 * 
 * @author generated with Laravel Schema Designer <laravelsd.com>
 */
class Language extends \Eloquent {

    use ModelBCUDTrait,
        RestoreOneTrait;

    protected $table = 'languages';

    /**
     * Indicates whether this model uses laravel's timestamps.
     * @var boolean 
     */
    public $timestamps = false;

    /**
     * Validations rules for creating a new Language.
     * @var array 
     */
    public static $create_rules = array(
        'locale' => 'alpha|required|min:2|max:2',
        'name' => 'alpha|required|min:2',
    );

    /**
     * Validation rules for updating an existing Language.
     * @var array 
     */
    public static $update_rules = array(
        'locale' => 'alpha|min:2|max:2|required',
        'name' => 'alpha|min:2',
    );

    /**
     * Get the Users to which a Language is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function users() {
        return $this->hasMany('Rockit\Models\User');
    }

}
