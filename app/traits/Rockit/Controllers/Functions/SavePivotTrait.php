<?php

namespace Rockit\Controllers\Functions;

trait SavePivotTrait {

    /**
     * Save a new model in the database with the provided valid data.
     * It's possible to check the existence before saving the model by setting the check_existence parameter to "true".
     * If you make it so you have to provide the name of the column upon which the check will be done.
     * The value that this column needs to match will be extract from the data parameter, assuming that its key is the same as the checked column.
     * 
     * @param string $model The class name of the model you want to save
     * @param array $data An array containing the data for the model. It is imperative that the keys for these data match the column name in the database.
     * @param boolean $check_existence Indicate if an existence checking needs to be done
     * @param string $column The name of the column upon which the check has to be done
     * @return mixed array : An array containing either a 'success', 'fail' or 'error' key depending on the result
     */
    public static function save($model, array $data, $check_existence = false, $column = 'id') {
        $call = self::$namespace . $model;
        if ($check_existence === true) {
            $object = $call::exist($data[$column], $column);
            if (is_object($object)) {
                $response = array('fail' => array(trans('fail.' . snake_case($model) . '.existing')));
            } else {
                $response = self::checkForeignKeys($data);
            }
        }
        if (!isset($response)) {
            $response = $call::createOne($data);
        }
        return $response;
    }

    protected static function checkForeignKeys($data) {
        $foreign_keys = array_where($data, function($key) {
            return ends_with($key, '_id');
        });
        $exist_foreign = self::checkForeignKeys($foreign_keys);
        $response = true;
        foreach ($foreign_keys as $key => $value) {
            $model = studly_case(preg_replace('#\_id$#u', '', $key));
            $call = self::$namespace . $model;
            $response = $call::exist($value);
        }
        return $response;
    }

}
