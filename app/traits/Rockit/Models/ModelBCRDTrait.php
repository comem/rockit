<?php

namespace Rockit\Models;

/**
 * This trait is used by models who needs to implements the following methods :
 * - exist()
 * - validate()
 * - createOne()
 * - restoreOne()
 * - deleteOne()
 */
trait ModelBCRDTrait {

    use Functions\BasModelTrait,
        Functions\CreateOneTrait,
        Functions\RestoreOneTrait,
        Functions\DeleteOneTrait;
}
