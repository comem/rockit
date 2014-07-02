<?php

namespace Rockit\Traits\Controllers\Functions;

/**
 * A trait that contains a generic <b>delete</b> method to be used by a Controller Trait.
 *
 * @author Mathias Oberson <mathias.oberson@heig-vd.ch>
 */
trait DeleteTrait {

    /**
     * Delete a specific model, by providing the class name and the id of the model to delete.
     * 
     * If the id provided does not point to an existing model of the class provided, a <b>Jsend::fail</b> is returned.<br>
     * 
     * @param string $model The class name of the desired Model (without its namespace)
     * @param integer $id The id of the Model to delete
     * @return Jsend
     */
    public static function delete($model, $id) {
        $call = self::$namespace . $model;
        $object = $call::exist($id);
        if ($object == null) {
            $response['fail'] = [snake_case($model) => [trans('fail.' . snake_case($model) . '.inexistant')]];
        } else {
            $response = $call::deleteOne($object);
        }
        return $response;
    }

}
