<?php

namespace Rockit\Models\Functions;

/**
 * A trait that contains a generic <b>updateOne</b> method to be used by a Model Trait.
 *
 * @author Mathias Oberson <mathias.oberson@heig-vd.ch>
 */
trait UpdateOneTrait {

    /**
     * Update a persistant Model in the database, using the differences between a set of new values provided and the old, existing values of the provided Model.
     *
     * The class of model to update corresponds to the class of model that called this function.<br>
     * The response field defined in that same model will be included in any return messages.<br>
     * The values are compared and the differences are passed to the <b>save</b> method of the class model to update, which returns a response.<br>
     * If that response was empty or there were no new values to update to, a <b>Jsend::fail</b> is returned.<br>
     * If the update was not executed correctly, a <b>Jsend::error</b> is returned.<br>
     * Or else, a <b>Jsend::success</b> is returned. 
     *
     * @param array $new_values The values to update to
     * @param Object $object The Model to update
     * @return array An array containing a 'success' or 'error' key with its message.
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
            $response['success'] = [
                'response' => [
                    'title' => trans('success.' . snake_case($class_name) . '.updated', array('name' => $object->$field)),
                ]
            ];
        } else if (empty($result) || empty($new_values)) {
            $response['fail'] = [snake_case($class_name) => [trans('fail.empty_data')]];
        } else {
            $response['error'] = trans('error.' . snake_case($class_name) . '.updated', array('name' => $object->$field));
        }
        return $response;
    }

}
