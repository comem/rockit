<?php

namespace Rockit\Controllers\Functions;

trait RenewTrait {

    /**
     * Reactive a previsouly soft deleted model whose column matches the provided value.
     * 
     * @param string $model 
     * @param array $data
     * @param string $column
     * @return mixed
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
