<?php

namespace Rockit\Models;

/**
 * A trait for Models that use the generic <b>validate</b> and <b>exist</b> methods in the base trait, as well as the <b>createOne</b> trait, <b>restoreOne</b> trait and <b>deleteOne</b> trait.
 *
 * @author Mathias Oberson <mathias.oberson@heig-vd.ch>
 */
trait ModelBCRDTrait {

    use Functions\BaseModelTrait,
        Functions\CreateOneTrait,
        Functions\RestoreOneTrait,
        Functions\DeleteOneTrait;
}
