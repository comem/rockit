<?php

namespace Rockit\Models;

trait CompletePivotModelTrait {

    use Functions\BaseModelTrait,
        Functions\CreateOneTrait,
        Functions\UpdateOneTrait,
        Functions\DeleteOneTrait;

    /**
     * Check that there is an existing relatioship between the models referenced by their ids in the data array.
     * Each id item in the array must have its key matching an attribute name, like "model_id" and an integer value.
     * 
     * @param array $data
     * @return null (doesn't exist) or object (exists)
     */
    public static function exist(array $data) {
        $query = self::select();
        foreach ($data as $key => $value) {
            if (ends_with('_id', $key)) {
                $query->where($key, '=', $value);
            }
        }
        return $query->first();
    }

}
