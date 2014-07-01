<?php

namespace Rockit\Controllers\Functions;

/**
 * A trait to declare in which namespace all the called Models are.
 * Any static variables declared here are accessible by other functions in this package.
 */
trait DeclareNamespaceTrait {

    /**
     * @var string The namespace in which all the called Models are.
     */
    protected static $namespace = 'Rockit\\';

}
