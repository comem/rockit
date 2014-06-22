<?php

namespace Rockit\Models;

/**
 * This trait is used by models who needs to implements the following methods :
 * - exist()
 * - validate()
 * - createOne()
 * - updateOne()
 * - deleteOne()
 */
trait ModelBCUDTrait {

    use Functions\BasModelTrait,
        Functions\CreateOneTrait,
        Functions\UpdateOneTrait,
        Functions\DeleteOneTrait;
}
