<?php

namespace Rockit\Traits\Models;

/**
 * A trait for the <b>complete pivot Models</b>.
 *
 * The following generic methods will be available when using this trait :<br>
 * <ul> 
 * <li>existByIds</li>
 * <li>validate</li>
 * <li>exist</li>
 * <li>createOne</li>
 * <li>updateOne</li>
 * <li>deleteOne</li>
 * </ul>
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
