<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use \Validator, \DB;

class Artist extends \Eloquent {

    use Models\ModelBCUDTrait;

    protected $table = 'artists';
    public $timestamps = true;

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    public static $response_field = 'id';
    public static $create_rules = array(
        'name' => 'required|min:1|max:100',
        'short_description_de' => 'max:200',
        'genres' => 'required',
    );
    public static $update_rules = array(
        'name' => 'min:1|max:100',
        'short_description_de' => 'max:200',
    );

    public function links() {
        return $this->hasMany('Rockit\Link');
    }

    public function genres() {
        return $this->belongsToMany('Rockit\Genre');
    }

    public function images() {
        return $this->hasMany('Rockit\Image');
    }

    public function lineups() {
        return $this->hasMany('Rockit\Lineup');
    }

    public function events() {
        return $this->belongsToMany('Rockit\Event')->withPivot('order', 'is_support', 'artist_hour_of_arrival');
    }

    /**
     * Create and save in the database a new Model with the provided data.
     * 
     * @param array $data The data for the Model to create
     * @param array $genres The genres to link with the newly created artist
     * @return array An array containing a key 'success' or 'error' depending on the result
     */
    public static function createOne($data) {
        $class = self::getClass();
        $field = self::$response_field;
        $genres = $data['genres'];
        unset($data['genres']);
        if (count($genres) > 0) {
            DB::beginTransaction();
            self::unguard();
            $object = self::create($data);
            if ($object != null) {
                $descriptions = array();
                foreach($genres as $genre) {
                    $inputs['genre_id'] = $genre;
                    $inputs['artist_id'] = $object->id;
                    $descriptions[] = Description::create($inputs);
                }
                if ($descriptions != null) {
                    $response['success'] = array(
                        'title' => trans('success.' . snake_case($class) . '.created', array('name' => $object->$field)),
                        'id' => $object->id,
                    );
                    DB::commit();
                } else {
                    $response['error'] = trans('error.' . snake_case($class) . '.genreerror', array('name' => $object->$field));
                    DB::rollback();
                }
            } else {
                $response['error'] = trans('error.' . snake_case($class) . '.created', array('name' => $object->$field));
                DB::rollback();
            }
        } else {
            $response['error'] = trans('error.' . snake_case($class) . '.nogenre', array('name' => $object->$field));
        }
        return $response;
    }

}
