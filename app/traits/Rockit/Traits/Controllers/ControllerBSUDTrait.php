<?php

namespace Rockit\Traits\Controllers;

/**
 * A trait for controllers that used the following generic methods :<br>
 * <ul> 
 * <li>save</li>
 * <li>modify</li>
 * <li>delete</li>
 * </ul>
 * This trait also declares in which <b>namespace</b> all the called Models are.<br>
 *
 * @author Mathias Oberson <mathias.oberson@heig-vd.ch>
 */
trait ControllerBSUDTrait {

    use Functions\DeclareNamespaceTrait,
        Functions\SaveTrait,
        Functions\ModifyTrait,
        Functions\DeleteTrait;
}
