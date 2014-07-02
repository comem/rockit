<?php

namespace Rockit\Traits\Models;

/**
 * A trait for simple pivot Models that use the generic <b>existByIds</b> method. It also uses the generic <b>validate</b> and <b>exist</b> methods in the base trait, as well as the <b>createOne</b> trait and <b>deleteOne</b> trait.
 *
 * @author Mathias Oberson <mathias.oberson@heig-vd.ch>
 */
trait SimplePivotModelTrait {

    use Functions\BaseModelTrait,
        Functions\CreateOneTrait,
        Functions\DeleteOneTrait;

    /**
     * Check that there is an existing relationship between the Models corresponding to the provided model names and model ids.
     * 
     * @param array $ids A list of model ids to use in order to check for an existing relationship  
     * @return Null or the Model that links the model ids together
     */
    public static function existByIds(array $ids) {
        $query = self::select();
        foreach ($ids as $key => $value) {
            $query->where($key, '=', $value);
        }
        return $query->first();
    }

}
