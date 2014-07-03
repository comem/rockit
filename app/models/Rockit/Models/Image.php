<?php

namespace Rockit\Models;

use \Route,
    \Request,
    Rockit\Models\Event,
    Rockit\Traits\Models\ModelBCUDTrait,
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
    protected $dates = ['deleted_at'];
    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];

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
        'source' => 'required|min:1|max:2000|path:images',
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
        return $this->belongsTo('Rockit\Models\Artist')->withTrashed();
    }

    /**
     * Get the Events to which an Image is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function events() {
        return $this->hasMany('Rockit\Models\Event');
    }

    /**
     * Update a persistant Image in the database, using the differences between a set of new values provided and the old, existing values of the provided Model.
     *
     * The values are compared and the differences are passed to the <b>save</b> method of the Image model to update, which returns a response.<br>
     * If that response was empty or there were no new values to update to, a <b>Jsend::fail</b> is returned.<br>
     * If the update was not executed correctly, a <b>Jsend::error</b> is returned.<br>
     * Or else, a <b>Jsend::success</b> is returned. 
     *
     * @param array $new_values The values to update to
     * @param Image $object The Image to update
     * @return array An array containing a 'success', 'fail' or 'error' key with its message.
     */
    public static function updateOne(array $new_values, Image $object) {
        $field = self::$response_field;
        if (array_key_exists('source', $new_values)) {
            if ($new_values['source'] != $object->source) {
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
