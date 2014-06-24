<?php

namespace Rockit\Models;

/**
 * This trait is used by models who needs to implements the following methods :
 * - exist()
 * - validate()
 * - createOne()
 * - updateOne()
 * - restoreOne()
 * - deleteOne()
 */
trait ModelBCURDTrait {

    use Functions\BasModelTrait,
        Functions\CreateOneTrait,
        Functions\UpdateOneTrait,
        Functions\RestoreOneTrait,
        Functions\DeleteOneTrait;
}
