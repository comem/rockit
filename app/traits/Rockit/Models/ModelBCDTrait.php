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

    use Functions\BasModelTrait,
        Functions\CreateOneTrait,
        Functions\DeleteOneTrait;
}
