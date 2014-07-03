<?php

namespace Rockit\Traits\Models;

/**
 * A trait for models that used the following generic methods :<br>
 * <ul> 
 * <li>validate</li>
 * <li>exist</li>
 * <li>createOne</li>
 * <li>updateOne</li>
 * <li>deleteOne</li>
 * </ul>
 *
 * @author Mathias Oberson <mathias.oberson@heig-vd.ch>
 */
trait ModelBCUDTrait {

    use Functions\BaseModelTrait,
        Functions\CreateOneTrait,
        Functions\UpdateOneTrait,
        Functions\DeleteOneTrait;
}
