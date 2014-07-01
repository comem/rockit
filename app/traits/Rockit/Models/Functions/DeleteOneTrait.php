<?php

namespace Rockit\Models\Functions;

/**
 * A trait that contains a generic <b>deleteOne</b> method to be used by a Model Trait.
 *
 * @author Mathias Oberson <mathias.oberson@heig-vd.ch>
 */
trait DeleteOneTrait {
    
    /**
     * Delete a persistant Model from the database that matches the provided Model.
     *
     * The class of model to delete corresponds to the class of model that called this function.<br>
     * The response field defined in that same model will be included in any return messages.<br>
     * The data is passed to the <b>delete</b> method of the class model to delete, which returns a response.<br>
     * If the provided Model was not deleted, a <b>Jsend::error</b> is returned.
     * Or else, a <b>Jsend::success</b> is returned.
     *
     *
     * @param Object $object The Model to delete
     * @return array An array containing a 'success' or 'error' key with its message.
     */
    public static function deleteOne($object) {
        $class_name = class_basename(get_called_class());
        $field = self::$response_field;
        if ($object->delete()) {
            $response['success'] = ['response' => [
                'title' => trans('success.' . snake_case($class_name) . '.deleted', ['name' => $object->$field]),
            ]];
        } else {
            $response['error'] = trans('error.' . snake_case($class_name) . '.deleted', ['name' => $object->$field]);
        }
        return $response;
    }

}
