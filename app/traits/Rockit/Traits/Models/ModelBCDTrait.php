<?php

namespace Rockit\Traits\Models;

/**
 * A trait for models that used the following generic methods :<br>
 * <ul> 
 * <li>validate</li>
 * <li>exist</li>
 * <li>createOne</li>
 * <li>deleteOne</li>
 * </ul>
 *
 * @author Mathias Oberson <mathias.oberson@heig-vd.ch>
 */
trait ModelBCDTrait {

    use Functions\BaseModelTrait,
        Functions\CreateOneTrait,
        Functions\DeleteOneTrait;
}
