<?php

namespace Rockit\Controllers;

/**
 * This trait is used by controllers who needs to implements the following methods :
 * - save() — interacts with a Model who implements the CreateOneTrait
 * - modify() — interacts with a Model who implements the UpdateOneTrait
 * - delete() — interacts with a Model who implements the DeleteOneTrait
 */
trait ControllerBSUDTrait {

    use Functions\DeclareNamespaceTrait,
        Functions\SaveTrait,
        Functions\ModifyTrait,
        Functions\DeleteTrait;
}
