<?php

namespace Rockit\Models\Functions;

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
        $class_name = class_basename(get_called_class());
        $field = self::$response_field;
        foreach ($new_values as $key => $value) {
            if ($value != null) {
                $object->$key = $value;
            }
        }
        $result = $object->save();
        if ($result === true) {
            $response['success'] = array(
                'title' => trans('success.' . snake_case($class_name) . '.updated', array('name' => $object->$field)),
                'id' => $object->id,
            );
        } else if (empty($result) || empty($new_values)) {
            $response['fail'] = [snake_case($class_name) => [trans('fail.empty_data')]];
        } else {
            $response['error'] = trans('error.' . snake_case($class_name) . '.updated', array('name' => $object->$field));
        }
        return $response;
    }

}
