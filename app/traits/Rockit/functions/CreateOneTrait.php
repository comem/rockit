<?php

namespace Rockit\functions;

trait CreateOneTrait {

    /**
     * Create and save in the database a new Model with the provided data.
     * 
     * @param array $data The data for the Model to create
     * @return array An array containing a key 'success' or 'error' depending on the result
     */
    public static function createOne($data) {
        $class = self::getClass();
        self::unguard();
        $object = self::create($data);
        if ($object != null) {
            $response['success'] = array(
                'title' => trans('success.' . $class . '.created'),
                'id' => $object->id,
            );
        } else {
            $response['error'] = trans('error.' . $class . '.created');
        }
        return $response;
    }

}
