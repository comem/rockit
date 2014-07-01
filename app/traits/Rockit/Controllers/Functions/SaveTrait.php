<?php

namespace Rockit\Controllers\Functions;

/**
 * A trait that contains a generic <b>save</b> method to be used by a Controller Trait.
 *
 * @author Mathias Oberson <mathias.oberson@heig-vd.ch>
 */
trait SaveTrait {

    /**
     * Save a new Model in the database with the provided validated data.
     *
     * If the 'check_existance' parameter is set to 'true', the existance will be checked before saving the Model.<br>
     * ?If you make it so you have to provide the name of the column upon which the check will be done.?
     * In this case, a column name must be provided in order to perform the existance check.<br>
     * The value that this column needs to match will be extracted from the data provided, and will assume that its key is the same as the column to check.<br>
     * If, during an existance check, a Model corresponding to the provided column name and column value exists, a <b>Jsend::fail</b> is returned.<br>  
     * Or else, the Model's data will be passed to the <b>createOne</b> method, which will return a response.<br>
     *
     * @param string $model The class name of the model you want to save
     * @param array $data An array containing the data for the model. It is imperative that the keys for this data match the column name in the database.
     * @param boolean $check_existance An existance check will be done if set to 'true'. By default, it is set to 'false'
     * @param string $column The name of the column upon which the check will be done
     * @return mixed array : An array containing either a 'success', 'fail' or 'error' key and message
     */
    public static function save($model, array $data, $check_existance = false, $column = 'id') {
        $call = self::$namespace . $model;
        $field = $call::$response_field;
        if ($check_existance === true) {
            $object = $call::exist($data[$column], $column);
            if (is_object($object)) {
                $response['fail'] = [snake_case($model) => [trans('fail.' . snake_case($model) . '.existing', ['name' => $object->$field])]];
            }
        }
        if (!isset($response)) {
            $response = $call::createOne($data);
        }
        return $response;
    }

}
