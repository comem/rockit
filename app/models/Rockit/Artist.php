<?php

namespace Rockit;

use \DB,
    Rockit\Image,
    Rockit\Models\ModelBCUDTrait,
    Illuminate\Database\Eloquent\SoftDeletingTrait;

class Artist extends \Eloquent {

    use SoftDeletingTrait,
        ModelBCUDTrait;

    /**
     * Indicates wether this model uses laravel's timestamps.
     * @var boolean 
     */
    public $timestamps = true;

    /**
     * Indicates which field value should be use in the return messages.
     * @var string 
     */
    public static $response_field = 'name';

    /**
     * Validation rules for creating a new Artist.
     * @var array 
     */
    public static $create_rules = array(
        'name' => 'required|min:1|max:100',
        'short_description_de' => 'max:200|min:1',
        'genres' => 'required|array|min:1',
        'images' => 'array',
    );

    /**
     * Validation rules for updating a new Artist.
     * @var array 
     */
    public static $update_rules = array(
        'name' => 'min:1|max:100',
        'short_description_de' => 'max:200',
    );
    protected $table = 'artists';
    protected $hidden = ['deleted_at'];
    protected $dates = ['deleted_at'];

    /**
     * Get the Links to which an Artist is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function links() {
        return $this->hasMany('Rockit\Link');
    }

    /**
     * Get the Genres to which an Artist is related with the id of this relationship.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function genres() {
        return $this->belongsToMany('Rockit\Genre', 'descriptions')->withPivot('id');
    }

    /**
     * Get the Images to which an Artist is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function images() {
        return $this->hasMany('Rockit\Image');
    }

    /**
     * Get the relationships between an 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function lineups() {
        return $this->hasMany('Rockit\Lineup')->groupBy('musician_id');
    }

    public function events() {
        return $this->belongsToMany('Rockit\Event', 'performers')
        ->withPivot('id')->groupBy('id');
    }

    public function musicians() {
        return $this->belongsToMany('Rockit\Musician', 'lineups')->groupBy('id');
    }

    public function scopeName($query, $string) {
        return $query->where('name', 'LIKE', '%' . $string . '%');
    }

    public function scopeGenres($query, array $genres) {
        return $query->whereHas('genres', function($q) use ($genres) {
            $q->whereIn('genres.id', $genres);
        });
    }

    public function scopeMusicianStagename($query, $string) {
        return $query->whereHas('musicians', function($q) use ($string) {
            $q->where('stagename', 'LIKE', '%' . $string . '%');
        });
    }

    public function scopeMusicianFirstname($query, $string) {
        return $query->whereHas('musicians', function($q) use ($string) {
            $q->where('stagename', 'LIKE', '%' . $string . '%');
        });
    }

    public function scopeMusicianLastname($query, $string) {
        return $query->whereHas('musicians', function($q) use ($string) {
            $q->where('stagename', 'LIKE', '%' . $string . '%');
        });
    }

    /**
     * Create and save in the database a new Model with the provided data.
     * 
     * Create the Artist first, and then proceed to create the relationships between this newly created Artist and the given Models ids.
     * 
     * @param array $data The data for the Model to create
     * @return array An array containing a key 'success' or 'error' depending on the result
     */
    public static function createOne($data) {
        $field = self::$response_field;
        $genres = $data['genres'];
        if (isset($data['images'])) {
            $images = $data['images'];
        }
        unset($data['genres']); // delete key/value to prepare data for self::create()
        unset($data['images']); // delete key/value to prepare data for self::create()
        DB::beginTransaction();
        self::unguard();
        $object = self::create($data);
        // check if object was created correctly
        if ($object != null) {
            $inputs['artist_id'] = $object->id;
            // insert all genre associations
            foreach ($genres as $genre) {
                $inputs['genre_id'] = $genre;
                $objectDescription = Description::create($inputs);
                // if an objectDescription was not created correctly, return response error message
                if ($objectDescription == null) {
                    $response['error'] = trans('error.description.created');
                    DB::rollback();
                    return $response;
                }
            }
            unset($inputs['genre_id']);
            // insert all image associations
            if (isset($images)) {
                foreach ($images as $image) {
                    $illustration = Image::find($image);
                    $illustration->artist_id = $inputs['artist_id'];
                    $illustration->save();
                }
            }
            $response['success'] = array(
                'title' => trans('success.artist.created', array('name' => $object->$field)),
                'id' => $object->id,
            );
            DB::commit();
        } else {
            $response['error'] = trans('error.artist.created', array('name' => $data[$field]));
            DB::rollback();
        }
        return $response;
    }

}
