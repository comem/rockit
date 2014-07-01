<?php

namespace Rockit\Controllers;

/**
 * A trait that uses a generic <b>savePivot</b> trait, <b>modify</b> trait and a <b>delete</b> trait. It also declares in which namespace all the called Models are.
 *
 * @author Mathias Oberson <mathias.oberson@heig-vd.ch>
 */
trait CompletePivotControllerTrait {

    use Functions\DeclareNamespaceTrait,
        Functions\SavePivotTrait,
        Functions\ModifyTrait,
        Functions\DeleteTrait;
}
