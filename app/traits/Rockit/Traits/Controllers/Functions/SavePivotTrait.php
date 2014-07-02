<?php

namespace Rockit\Traits\Controllers\Functions;

/**
 * A trait that contains a generic <b>save</b> method to be used by a Controller Trait of a pivot table.
 *
 * @author Mathias Oberson <mathias.oberson@heig-vd.ch>
 */
trait SavePivotTrait {

    /**
     * Save a new pivot Model in the database between the Models corresponding to the provided model ids.
     * 
     * ?It's possible to check the existence before saving the model by setting the check_existEnce parameter to "true".?
     * ?If you make it so you have to provide the name of the column upon which the check will be done.?
     * ?The value that this column needs to match will be extract from the data parameter, assuming that its key is the same as the checked column.?
     * 
     * If the pivot Model already exists, a <b>Jsend::fail</> is returned.<br>
     * Or else the pivot Model's data and the model ids of the Models to associate will be passed to the <b>createOne</b> method, which will return a response.<br>
     *
     * @param string $pivot_model The class name of the pivot Model you want to save
     * @param array $data An array containing the data for the pivot, which includes the model ids of the Models that the pivot Model will associate. 
     * @return Jsend array An array containing either a 'success', 'fail' or 'error' key and message
     */
    public static function save($pivot_model, array $data) {
        $call = self::$namespace . $pivot_model;
        $object = $call::existByIds($data);
        if (is_object($object)) {
            $response['fail'] = [snake_case($pivot_model) => [trans('fail.' . snake_case($pivot_model) . '.existing')]];
        }
        if (!isset($response)) {
            $response = $call::createOne($data);
        }
        return $response;
    }

}
