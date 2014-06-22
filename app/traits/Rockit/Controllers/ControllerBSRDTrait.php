<?php

namespace Rockit\Controllers;

/**
 * This trait is used by controllers who needs to implements the following methods :
 * - save() — interacts with a Model who implements the CreateOneTrait
 * - renew() — interacts with a Model who implements the RestoreOneTrait
 * - delete() — interacts with a Model who implements the DeleteOneTrait
 */
trait ControllerBSRDTrait {

    use Functions\DeclareNamespaceTrait,
        Functions\SaveTrait,
        Functions\RenewTrait,
        Functions\DeleteTrait;
}
