<?php

namespace Rockit;

/**
 * This trait is used by models who needs to implements the following methods :
 * - exist()
 * - validate()
 * - createOne()
 * - updateOne()
 * - deleteOne()
 */
trait ModelBCUDTrait {

    use functions\BasModelTrait,
        functions\CreateOneTrait,
        functions\UpdateOneTrait,
        functions\DeleteOneTrait;
}
