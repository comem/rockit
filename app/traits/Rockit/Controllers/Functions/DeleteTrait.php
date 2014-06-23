<?php

namespace Rockit\Controllers\Functions;

trait DeleteTrait {

    /**
     * Delete a specified model, referenced by its id.
     * 
     * @param string $model The class name of the desired Model (without its namespace)
     * @param integer $id The identifier of the Model to delete
     */
    public static function delete($model, $id) {
        $call = self::$namespace . $model;
        $object = $call::exist($id);
        if ($object == null) {
            $response = array(
                'fail' => array(
                    'title' => trans('fail.' . snake_case($model) . '.inexistant'),
                    'id' => (int) $id,
                ),
            );
        } else {
            $response = $call::deleteOne($object);
        }
        return $response;
    }

}
