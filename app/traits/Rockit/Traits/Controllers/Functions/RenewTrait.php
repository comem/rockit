<?php

namespace Rockit\Traits\Controllers\Functions;

/**
 * A trait that contains a generic <b>renew</b> method to be used by a Controller Trait.
 *
 * @author Mathias Oberson <mathias.oberson@heig-vd.ch>
 */
trait RenewTrait {

    /**
     * Reactive a previsouly soft deleted model whose column matches the provided value.
     * 
     * @return mixed
     */
    /**
     * Reactivate a previously soft-deleted Model, by providing the class name and the column-value of the Model to reactivate, with the name of that column.
     * 
     * If the id provided does not point to a currently soft-deleted model of the class provided, a boolean <b>false</b> is returned.<br>
     * Or else, the Model's column name and value is passed to the <b>restoreOne</b> method, which will return a response.<br>
     *
     * @param string $model The class name of the desired Model (without its namespace)
     * @param array $data An array that contains the value desired, which will designate a Model to be renewed
     * @param string $column The name of the column to use when designating a Model to renew.
     * @return mixed Boolean 'false' or an array containing either a 'success' or 'error' key
     */
    public static function renew($model, $data, $column = 'name_de') {
        $call = self::$namespace . $model;
        $trashed_model = $call::onlyTrashed()->where($column, '=', $data[$column])->first();
        if (is_object($trashed_model)) {
            $response = $call::restoreOne($trashed_model);
        }
        return isset($response) ? $response : false;
    }

}
