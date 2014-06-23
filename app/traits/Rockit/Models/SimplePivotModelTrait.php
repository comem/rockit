<?php

namespace Rockit\Models;

trait SimplePivotModelTrait {

    use Functions\BaseModelTrait,
        Functions\CreateOneTrait,
        Functions\DeleteOneTrait;

    /**
     * Check that there is an existing relatioship between the models referenced by their ids.
     * Each item in the ids array must have its key matching an attribute name, like "model_id", and an integer value.
     * 
     * @param array $ids
     * @return null (doesn't exist) or object (exists)
     */
    public static function existByIds(array $ids) {
        $query = self::select();
        foreach ($ids as $key => $value) {
            $query->where($key, '=', $value);
        }
        return $query->first();
    }

}
