<?php

namespace Rockit\Models;

/**
 * A trait for complete pivot Models that use the generic <b>existByIds</b> method. It also uses the generic <b>validate</b> and <b>exist</b> methods in the base trait, as well as the <b>createOne</b> trait, <b>updateOne</b> trait and <b>deleteOne</b> trait.
 *
 * @author Mathias Oberson <mathias.oberson@heig-vd.ch>
 */
trait CompletePivotModelTrait {

    use Functions\BaseModelTrait,
        Functions\CreateOneTrait,
        Functions\UpdateOneTrait,
        Functions\DeleteOneTrait;

    /**
     * Check that there is an existing relationship between the Models corresponding to the provided model names and model ids.
     * 
     * @param array $data Data that contains the model ids to use in order to check for an existing relationship  
     * @return Null or the Model that links the model ids together
     */
    public static function existByIds(array $data) {
        $query = self::select();
        foreach ($data as $key => $value) {
            if (ends_with($key, '_id')) {
                $query->where($key, '=', $value);
            }
        }
        return $query->first();
    }

}
