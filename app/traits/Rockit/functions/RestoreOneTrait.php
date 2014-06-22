<?php

namespace Rockit\functions;

trait RestoreOneTrait {

    /**
     * Restore a previsouly soft deleted Model
     * 
     * @param Object $object The trashed Model to restore
     * @return 
     */
    public static function restoreOne($object) {
        $class_name = self::getClass();
        if ($object->restore()) {
            $response['success'] = array(
                'title' => trans('success.' . $class_name . '.restored'),
                'id' => $object->id,
            );
        } else {
            $response['error'] = trans('error.' . $class_name . '.restored');
        }
        return $response;
    }

}
