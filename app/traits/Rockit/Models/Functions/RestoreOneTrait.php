<?php

namespace Rockit\Models\Functions;

trait RestoreOneTrait {

    /**
     * Restore a previsouly soft deleted Model
     * 
     * @param Object $object The trashed Model to restore
     * @return 
     */
    public static function restoreOne($object) {
        $class_name = self::getClass();
        $field = self::$response_field;
        if ($object->restore()) {
            $response['success'] = array(
                'title' => trans('success.' . snake_case($class_name) . '.restored', array('name' => $object->$field)),
                'id' => $object->id,
            );
        } else {
            $response['error'] = trans('error.' . snake_case($class_name) . '.restored', array('name' => $object->$field));
        }
        return $response;
    }

}
