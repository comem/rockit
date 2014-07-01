<?php

namespace Rockit\Models\Functions;

trait CreateOneTrait {

    /**
     * Create and save in the database a new Model with the provided data.
     * 
     * @param array $data The data for the Model to create
     * @return array An array containing a key 'success' or 'error' depending on the result
     */
    public static function createOne($data) {
        $class = class_basename(get_called_class());
        $field = self::$response_field;
        self::unguard();
        $object = self::create($data);
        if ($object != null) {
            $response['success'] = ['response' => [
                'title' => trans('success.' . snake_case($class) . '.created', ['name' => $object->$field]),
                'id' => $object->id,
            ]];
        } else {
            $response['error'] = trans('error.' . snake_case($class) . '.created', ['name' => $object->$field]);
        }
        return $response;
    }

}
