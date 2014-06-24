<?php

namespace Rockit\Controllers\Functions;

trait ModifyTrait {

    /**
     * Modify a specified model, referenced by its id, with an array of new data.
     * 
     * @param string $model The class name of the desired Model (without its namespace)
     * @param integer $id The identifier of the Model to modify
     * @param array $new_data An array containing the new data
     * @return array An array containing the results of the modifications.
     */
    public static function modify($model, $id, $new_data) {
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
            $response = $call::updateOne($new_data, $object);
        }
        return $response;
    }

}
