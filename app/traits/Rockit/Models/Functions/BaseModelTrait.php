<?php

namespace Rockit\Models\Functions;

use \Validator;

/**
 * A trait that contains a generic <b>validate</b> method to be used as a base by a Model Trait.
 *
 * @author Mathias Oberson <mathias.oberson@heig-vd.ch>
 */
trait BaseModelTrait {

    /**
     * Check that the provided data is valid according to the provided set of rules.
     *
     * If the validation fails, a <b>Jsend::fail</b> is returned.
     * Or else the validation has passed, and a boolean 'true' is returned.
     * 
     * @param array $data The data to validate
     * @param array $rules The rules to apply in order to validate the data
     * @return boolean 'true' or a Jsend fail message 
     */
    public static function validate(array &$data, array $rules) {
        $data = array_filter($data, function($item) {
            return $item !== null;
        });
        $v = Validator::make($data, $rules);
        if ($v->fails()) {
            $response['fail'] = $v->messages()->getMessages();
        } else {
            $response = true;
        }
        return $response;
    }

    /**
     * Check that there is a persistant Model whose column matches the provided name and value.
     * 
     * If no column name is provided, then the default column name 'id' is used to check for an existing Model.<br>
     * If there is no Model that matches the provided column name and value, a 'null' is returned.
     * 
     * @param mixed $value The value that the column must match
     * @param type $column The column that needs to match the value
     * @return Model existingModel or null 
     */
    public static function exist($value, $column = 'id') {
        return self::where($column, '=', $value)->first();
    }
    
}
