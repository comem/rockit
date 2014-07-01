<?php

namespace Rockit\Controllers;

/**
 * A trait that uses a generic <b>save</b> trait, <b>renew</b> trait and a <b>delete</b> trait. It also declares in which namespace all the called Models are.
 *
 * @author Mathias Oberson <mathias.oberson@heig-vd.ch>
 */
trait ControllerBSRDTrait {

    use Functions\DeclareNamespaceTrait,
        Functions\SaveTrait,
        Functions\RenewTrait,
        Functions\DeleteTrait;
}
