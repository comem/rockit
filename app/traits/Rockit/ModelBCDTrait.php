<?php

namespace Rockit;

/**
 * This trait is used by models who needs to implements the following methods :
 * - exist()
 * - validate()
 * - createOne()
 * - deleteOne()
 */
trait ModelBCDTrait {

    use functions\BasModelTrait,
        functions\CreateOneTrait,
        functions\DeleteOneTrait;
}
