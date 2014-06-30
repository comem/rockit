<?php

namespace Rockit\Models\Functions;

use \Validator;

trait BaseModelTrait {

    /**
     * Check that the provided datas are valid according to the choosed set of rules.
     * 
     * @param array $data The data to check
     * @param array $rules The rules to apply to the data
     * @return mixed true : the data are valids. array : an array containing the fail messages 
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
     * Check if there is a persistant Model whose column matches the provided value.
     * If no column is provided, the function tests the existence on an 'id' column.
     * 
     * @param mixed $value The value that the column must match
     * @param type $column The column that needs to match the value
     * @return Model : an instance of the model if existant. null : the given value does not match any model.
     */
    public static function exist($value, $column = 'id') {
        return self::where($column, '=', $value)->first();
    }
    
}
