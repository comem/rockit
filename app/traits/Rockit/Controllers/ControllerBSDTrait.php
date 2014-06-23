<?php

namespace Rockit\Controllers;

/**
 * This trait is used by controllers who needs to implements the following methods :
 * - save() — interacts with a Model who implements the CreateOneTrait
 * - delete() — interacts with a Model who implements the DeleteOneTrait
 */
trait ControllerBSDTrait {

    use Functions\DeclareNamespaceTrait,
        Functions\SaveTrait,
        Functions\DeleteTrait;
}
