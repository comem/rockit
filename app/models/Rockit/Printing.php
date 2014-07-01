<?php

namespace Rockit;

use \Route,
    \Request,
    Rockit\Models\CompletePivotModelTrait;

class Printing extends \Eloquent {

    use CompletePivotModelTrait;

    protected $table = 'printings';
    protected $hidden = ['printing_type_id', 'event_id'];
    public $timestamps = false;
    public static $create_rules = [
        'nb_copies' => 'integer|required|min:0',
        'nb_copies_surplus' => 'integer|min:0',
        'event_id' => 'integer|required|min:1|exists:events,id',
        'printing_type_id' => 'integer|required|min:1|exists:printing_types,id',
        'source' => 'required|path:printings|max:100|min:1|unique:printings',
    ];
    public static $update_rules = [
        'nb_copies' => 'integer|min:0',
        'nb_copies_surplus' => 'integer|min:0',
        'source' => 'path:printings|max:100|min:1|unique:printings',
    ];
    public static $response_field = 'id';

    public function printingType() {
        return $this->belongsTo('Rockit\PrintingType');
    }

    public function event() {
        return $this->belongsTo('Rockit\Event');
    }

    /**
     * Update a persistant Model, based on the difference between new values
     * and existing values.
     * 
     * If the source attribute is modified, the file referenced by the old value is deleted.
     *
     * @param array $new_values
     * @param Printing $printing
     * @return true or error message
     */
    public static function updateOne(array $new_values, Printing $printing) {
        $field = self::$response_field;
        if (array_key_exists('source', $new_values)) {
            // Create an url to delete the old source
            $url = 'v1/files/' . $printing->source;
        }
        foreach ($new_values as $key => $value) {
            if ($value != null) {
                $printing->$key = $value;
            }
        }
        $result = $printing->save();
        if ($result === true) {
            if (isset($url)) {
                Route::dispatch(Request::create($url, 'DELETE'));
            }
            $response['success'] = ['response' => [
                    'title' => trans('success.printing.updated', array('name' => $printing->$field)),
            ]];
        } else if (empty($result) || empty($new_values)) {
            $response['fail'] = ['printing' => [trans('fail.empty_data')]];
        } else {
            $response['error'] = trans('error.printing.updated', array('name' => $printing->$field));
        }
        return $response;
    }

    /**
     * Delete a persistant Model
     *
     * @param Object $object The Model to delete
     * @return true or error message
     */
    public static function deleteOne($object) {
        $field = self::$response_field;
        if ($object->delete()) {
            if (!empty($object->source)) {
                $url = 'v1/files/' . $object->source;
                Route::dispatch(Request::create($url, 'DELETE'));
            }
            $response['success'] = ['response' => [
                    'title' => trans('success.printing.deleted', ['name' => $object->$field]),
            ]];
        } else {
            $response['error'] = trans('error.printing.deleted', ['name' => $object->$field]);
        }
        return $response;
    }

}
