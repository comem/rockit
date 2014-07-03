<?php

namespace Rockit\Traits\Controllers;

/**
 * A trait for the controllers of <b>pivot Models</b>.
 *
 * The following generic methods will be available when using this trait :<br>
 * <ul> 
 * <li>save</li>
 * <li>modify</li>
 * <li>delete</li>
 * </ul>
 * This trait also declares in which <b>namespace</b> all the called Models are.<br>
 *
 * @author Mathias Oberson <mathias.oberson@heig-vd.ch>
 */
trait CompletePivotControllerTrait {

    use Functions\DeclareNamespaceTrait,
        Functions\SavePivotTrait,
        Functions\ModifyTrait,
        Functions\DeleteTrait;
}
