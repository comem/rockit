<?php

namespace Rockit\Models\Functions;

/**
 * A trait that contains a generic <b>restoreOne</b> method to be used by a Model Trait.
 *
 * @author Mathias Oberson <mathias.oberson@heig-vd.ch>
 */
trait RestoreOneTrait {
    
    /**
     * Restore a previously soft-deleted Model in the database.
     *
     * The class of model to update corresponds to the class of model that calls this function.<br>
     * The response field defined in that same model will be included in any return messages.<br>
     * The values are compared and the differences are passed to the <b>save</b> method of the class model to update, which will return a response.<br>
     * If that response was empty or there were no new values to update to, a <b>Jsend::fail</b> is returned.<br>
     * If the update was not executed correctly, a <b>Jsend::error</b> is returned.<br>
     * Or else, a <b>Jsend::success</b> is returned. 
     *
     * @param Object $object The soft-deleted Model to restore
     * @return array An array containing a 'success' or 'error' key with its message.
     */
    public static function restoreOne($object) {
        $class_name = class_basename(get_called_class());
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
