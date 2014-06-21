<?php

namespace Rockit;

use \Validator;

trait RockitModelTrait {

    private static function getClass() {
        $class = explode('\\', mb_strtolower(get_called_class()));
        return end($class);
    }

    /**
     * Check that the provided datas are valids according to the choosed set of rules.
     * 
     * @param array $data The data to check
     * @param array $rules The rules to apply to the data
     * @return mixed true : the data are valids. array : an array containing the fail messages 
     */
    public static function validate(array $data, array $rules) {
        $v = Validator::make($data, $rules);
        if ($v->fails()) {
            $response['fail'] = $v->messages()->getMessages();
        } else {
            $response = true;
        }
        return $response;
    }

    /**
     * Create and save in the database a new Model with the provided data.
     * 
     * @param array $data The data for the Model to create
     * @return array 
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

    /**
     * Update a persistant Model, based on the difference between new values
     * and existing values.
     *
     * @param array $new_values
     * @param Object $object
     * @return true or error message
     */
    public static function updateOne(array $new_values, $object) {
        $class_name = self::getClass();
        foreach ($new_values as $key => $value) {
            if ($value != null) {
                $object->$key = $value;
            }
        }
        if ($object->save()) {
            $response['success'] = array(
                'title' => trans('success.' . $class_name . '.updated'),
                'id' => $object->id,
            );
        } else {
            $response['error'] = trans('error.' . $class_name . '.updated');
        }
        return $response;
    }

    /**
     * Delete a persistant Model
     *
     * @param Object $object
     * @return true or error message
     */
    public static function deleteOne($object) {
        $class_name = self::getClass();
        if ($object->delete()) {
            $response['success'] = array(
                'title' => trans('success.' . $class_name . '.deleted'),
            );
        } else {
            $response['error'] = trans('error.' . $class_name . '.deleted');
        }
        return $response;
    }

    /**
     * Restore a previsouly soft deleted Model
     * 
     * @param Object $object The trashed Model to restore
     * @return 
     */
    public static function restoreOne($object) {
        $class_name = self::getClass();
        if ($object->restore()) {
            $response['success'] = array(
                'title' => trans('success.' . $class_name . '.restored'),
            );
        } else {
            $response['error'] = trans('error.' . $class_name . '.restored');
        }
        return $response;
    }

}
