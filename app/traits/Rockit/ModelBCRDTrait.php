<?php

namespace Rockit;

/**
 * This trait is used by models who needs to implements the following methods :
 * - exist()
 * - validate()
 * - createOne()
 * - restoreOne()
 * - deleteOne()
 */
trait ModelBCRDTrait {

    use functions\BasModelTrait,
        functions\CreateOneTrait,
        functions\RestoreOneTrait,
        functions\DeleteOneTrait;
}
