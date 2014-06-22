<?php

namespace Rockit\functions;

trait UpdateOneTrait {
    
    /**
     * Update a persistant Model, based on the difference between new values
     * and existing values.
     *
     * @param array $new_values
     * @param Object $object
     * @return true or error message
     */
    public static function updateOne(array $new_values, $object) {
        $class_name = self::getClass();
        foreach ($new_values as $key => $value) {
            if ($value != null) {
                $object->$key = $value;
            }
        }
        if ($object->save()) {
            $response['success'] = array(
                'title' => trans('success.' . $class_name . '.updated'),
                'id' => $object->id,
            );
        } else {
            $response['error'] = trans('error.' . $class_name . '.updated');
        }
        return $response;
    }

}
