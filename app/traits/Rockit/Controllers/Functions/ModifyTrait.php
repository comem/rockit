<?php

namespace Rockit\Controllers\Functions;

/**
 * A trait that contains a generic modify method to be used by a Controller Trait.
 *
 * @author Mathias Oberson <mathias.oberson@heig-vd.ch>
 */
trait ModifyTrait {

    /**
     * Modify a specific Model, by providing the class name and the id of the model to modify, with the new data to update to.
     * 
     * If the id provided does not point to an existing model of the class provided, a <b>Jsend::fail</b> is returned.<br>
     * Or else, the specific model and the new data is passed to the <b>updateOne</b> method, which will return a response.<br>
     *
     * @param string $model The class name of the desired Model (without its namespace)
     * @param integer $id The id of the Model to modify
     * @param array $new_data An array containing the new data
     * @return array An array containing the results of the modifications.
     */
    public static function modify($model, $id, $new_data) {
        $call = self::$namespace . $model;
        $object = $call::exist($id);
        if ($object == null) {
            $response['fail'] = [snake_case($model) => [trans('fail.' . snake_case($model) . '.inexistant')]];
        } else {
            $response = $call::updateOne($new_data, $object);
        }
        return $response;
    }

}
