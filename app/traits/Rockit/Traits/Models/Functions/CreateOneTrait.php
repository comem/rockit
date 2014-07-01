<?php

namespace Rockit\Traits\Models\Functions;

/**
 * A trait that contains a generic <b>createOne</b> method to be used by a Model Trait.
 *
 * @author Mathias Oberson <mathias.oberson@heig-vd.ch>
 */
trait CreateOneTrait {

    /**
     * Create and save a new Model in the database with the provided data.
     *
     * The class of model to create corresponds to the class of model that called this function.<br>
     * The response field defined in that same model will be included in any return messages.<br>
     * The data is passed to the <b>create</b> method of the class model to create, which returns a response.<br>
     * If that response is 'null', a <b>Jsend::error</b> is returned.
     * Or else, a <b>Jsend::success</b> is returned.
     * 
     * @param array $data The data for the Model to create
     * @return array An array containing a 'success' or 'error' key with its message.
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
