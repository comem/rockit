<?php

namespace Rockit\Models;

/**
 * This trait is used by models who needs to implements the following methods :
 * - exist()
 * - validate()
 * - createOne()
 * - deleteOne()
 */
trait ModelBCDTrait {

    use Functions\BaseModelTrait,
        Functions\CreateOneTrait,
        Functions\DeleteOneTrait;
}
