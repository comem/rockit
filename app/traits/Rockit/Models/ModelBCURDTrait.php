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

    use Functions\BaseModelTrait,
        Functions\CreateOneTrait,
        Functions\UpdateOneTrait,
        Functions\RestoreOneTrait,
        Functions\DeleteOneTrait;
}
