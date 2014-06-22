<?php

namespace Rockit;

trait FunctionnalServicesTrait {

    /**
     * @var string The namespace in which all the called Models are.
     */
    protected static $namespace = 'Rockit\\';

    /**
     * Save a new model in the database with the provided valid data.
     * It's possible to check the existence before saving the model by setting the check_existence parameter to "true".
     * If you make it so, provide an array of the attribute's name upon which the check will be done and the values that they need to match.
     * 
     * @param string $model
     * @param array $data
     * @param boolean $check_existence
     * @param mixed $matching_value
     * @param string $identifier
     */
    public static function save($model, array $data, $check_existence = false, $matching_value = null, $identifier = 'id') {
        $call = self::$namespace . $model;
        if ($check_existence === true) {
            $object = $call::exist($matching_value, $identifier);
            if (is_object($object)) {
                $response = array('fail' => trans('fail.' . snake_case($model) . '.existing'));
            } else {
                $response = true;
            }
        } else {
            $response = true;
        }
        if ($response === true) {
            $response = $call::createOne($data);
        }
        return $response;
    }

    /**
     * Reactive a previsouly soft deleted model that column matches the provided value.
     * 
     * @param type $model
     * @param type $name
     * @param type $column
     * @return type
     */
    public static function renew($model, $data, $column = 'name_de') {
        $call = self::$namespace . $model;
        $response = false;
        $trashed_model = $call::onlyTrashed()->where($column, '=', $data[$column])->first();
        if (is_object($trashed_model)) {
            $trashed_model->restore();
            $response = array('success' => array(
                    'title' => trans('success.' . snake_case($model) . 'restored'),
                    'id' => $trashed_model->id,
            ));
        }
        return $response;
    }

    /**
     * Modify a specified model, referenced by its id, with an array of new data.
     * 
     * @param string $model The class name of the desired Model (without its namespace)
     * @param integer $id The identifier of the Model to modify
     * @param array $new_data An array containing the new data
     * @return array An array containing the results of the modifications.
     */
    public static function modify($model, $id, $new_data) {
        $call = self::$namespace . $model;
        $object = $call::exist($id);
        if ($object == null) {
            $response = array(
                'fail' => array(
                    'title' => trans('fail.' . snake_case($model) . '.inexistant'),
                    'id' => (int) $id,
                ),
            );
        } else {
            $response = $call::updateOne($new_data, $object);
        }
        return $response;
    }

    /**
     * Delete a specified model, referenced by its id.
     * 
     * @param string $model The class name of the desired Model (without its namespace)
     * @param integer $id The identifier of the Model to delete
     */
    public static function delete($model, $id) {
        $call = self::$namespace . $model;
        $object = $call::exist($id);
        if ($object == null) {
            $response = array(
                'fail' => array(
                    'title' => trans('fail.' . snake_case($model) . '.inexistant'),
                    'id' => (int) $id,
                ),
            );
        } else {
            $response = $call::deleteOne($object);
        }
        return $response;
    }

}
