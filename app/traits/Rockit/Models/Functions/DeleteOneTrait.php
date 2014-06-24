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
        $class_name = self::getClass();
        if ($object->delete()) {
            $response['success'] = array(
                'title' => trans('success.' . $class_name . '.deleted'),
            );
        } else {
            $response['error'] = trans('error.' . $class_name . '.deleted');
        }
        return $response;
    }

}
