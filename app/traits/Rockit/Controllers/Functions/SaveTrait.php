<?php

namespace Rockit\Controllers\Functions;

trait SaveTrait {

    /**
     * Save a new pivot in the database between the provided models referenced by their ids.
     * It's possible to check the existence before saving the model by setting the check_existence parameter to "true".
     * If you make it so you have to provide the name of the column upon which the check will be done.
     * The value that this column needs to match will be extract from the data parameter, assuming that its key is the same as the checked column.
     * 
     * @param string $pivot_model The class name of the pivot you want to save
     * @param array $data An array containing the data for the pivot. It is imperative that the keys of these data match the column name in the database.
     * @return mixed array : An array containing either a 'success', 'fail' or 'error' key depending on the result
     */
    public static function save($pivot_model, array $data) {
        $call = self::$namespace . $pivot_model;
        $object = $call::existByIds($data);
        if (is_object($object)) {
            $response = array('fail' => trans('fail.' . snake_case($pivot_model) . '.existing'));
        }
        if (!isset($response)) {
            $response = $call::createOne($data);
        }
        return $response;
    }

}
