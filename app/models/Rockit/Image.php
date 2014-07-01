<?php

namespace Rockit;

use Rockit\Models\ModelBCUDTrait,
    Rockit\Event,
    \Route,
    \Request,
    Illuminate\Database\Eloquent\SoftDeletingTrait;

/**
 * Contains the attributes and methods of an Image model in the database.<br>
 * An Image can illustrate an Artist and/or symbolize an Event.<br>
 * Based on the Laravel's Eloquent.<br>
 * 
 * @author generated with Laravel Schema Designer <laravelsd.com>
 * @author Mathias Oberson <mathias.oberson@heig-vd.ch>
 */
class Image extends \Eloquent {

    use SoftDeletingTrait,
        ModelBCUDTrait;

    protected $table = 'images';
    protected $hidden = array('deleted_at');
    protected $dates = array('deleted_at');

    /**
     * Indicates whether this model uses laravel's timestamps.
     * @var boolean 
     */
    public $timestamps = true;

    /**
     * Indicates which field value should be used in the return messages.
     * @var string 
     */
    public static $response_field = 'source';

    /**
     * Validation rules for creating a new Image.
     * @var array 
     */
    public static $create_rules = array(
        'source' => 'required|min:1|max:2000|path:images|unique:images',
        'alt_de' => 'max:100|min:1',
        'caption_de' => 'max:200|min:1',
    );

    /**
     * Validation rules for updating an existing Image.
     * @var array 
     */
    public static $update_rules = array(
        'source' => 'min:1|max:2000|path:images',
        'alt_de' => 'max:100|min:1',
        'caption_de' => 'max:200|min:1',
    );

    /**
     * Get the Artist to which an Image is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function artist() {
        return $this->belongsTo('Rockit\Artist');
    }

    /**
     * Get the Events to which an Image is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function events() {
        return $this->hasMany('Rockit\Event');
    }

    /**
     * Updates a persistant image, based on the difference between new values
     * and existing values.
     * 
     * If the sourcefile is changed, delete the old file and add the new one.
     * 
     * @param array $new_values
     * @param \Rockit\Image $object
     * @return type
     */
    public static function updateOne(array $new_values, Image $object) {
        $field = self::$response_field;
        if (array_key_exists('source', $new_values)) {
            if($new_values['source'] != $object->source) {
                // Create an url to delete the old source
                $url = 'v1/files/' . $object->source;
            }    
        }
        foreach ($new_values as $key => $value) {
            if ($value != null) {
                $object->$key = $value;
            }
        }
        $result = $object->save();
        if ($result === true) {
            if (isset($url)) {
                Route::dispatch(Request::create($url, 'DELETE'));
            }
            $response['success'] = ['response' => [
                    'title' => trans('success.image.updated', array('name' => $object->$field)),
            ]];
        } else if (empty($result) || empty($new_values)) {
            $response['fail'] = ['image' => [trans('fail.empty_data')]];
        } else {
            $response['error'] = trans('error.image.updated', array('name' => $object->$field));
        }
        return $response;
    }
    
   
    
    /**
     * Check that an Image illustrates an Artist is a Performer at the specified Event, with the provided Image and Event.
     *
     * If provided Image does not illustrate an Artist that performs at the provided Event, a <b>Jsend:fail</b> is returned.<br>
     * Or else a boolean 'true' is returned.<br>
     * @return a boolean 'true' or a Jsend:fail message
     */
    public static function checkPerformer(Image $image, Event $event) {
        $response = Event::whereHas('performers', function ($q) use ($image) {
            $q->where('artist_id', '=', $image->artist_id);
        })->find($event->id);
        if ($response != NULL) {
            $response = true;
        } else {
            $response['fail'] = [
                'symbolization' => [trans('fail.symbolization.attach_image_not_performer')],
            ];
        }
        return $response;
    }

}
