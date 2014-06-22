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
     * If you make it so you have to provide the name of the column upon which the check will be done.
     * The value that this column needs to match will be extract from the data parameter, assuming that its key is the same as the checked column.
     * 
     * @param string $model The class name of the model you want to save
     * @param array $data An array containing the data for the model. It is imperative that the keys for these data match the column name in the database.
     * @param boolean $check_existence Indicate if an existence checking needs to be done
     * @param string $column The name of the column upon which the check has to be done
     * @return mixed array : An array containing either a 'success', 'fail' or 'error' key depending on the result

     */
    public static function save($model, array $data, $check_existence = false, $column = 'id') {
        $call = self::$namespace . $model;
        if ($check_existence === true) {
            $object = $call::exist($data[$column], $column);
            if (is_object($object)) {
                $response = array('fail' => trans('fail.' . snake_case($model) . '.existing'));
            }
        }
        if (!isset($response)) {
            $response = $call::createOne($data);
        }
        return $response;
    }

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
