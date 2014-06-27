<?php

namespace Rockit\Models\Functions;

trait DeleteOneTrait {
    
    /**
     * Delete a persistant Model
     *
     * @param Object $object The Model to delete
     * @return true or error message
     */
    public static function deleteOne($object) {
        $class_name = class_basename(get_called_class());
        $field = self::$response_field;
        if ($object->delete()) {
            $response['success'] = array(
                'title' => trans('success.' . snake_case($class_name) . '.deleted', array('name' => $object->$field)),
            );
        } else {
            $response['error'] = trans('error.' . snake_case($class_name) . '.deleted', array('name' => $object->$field));
        }
        return $response;
    }

}
