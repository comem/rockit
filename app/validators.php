<?php

/**
 * Validation check for phone number.
 * Accepts only :
 *  - an optionnal "+" sign in the beginning
 *  - numbers from 0 to 9
 *  - dots
 *  - slashs
 *  - whitespaces
 *  */
Validator::extend('phone', function($field, $value, $parameters) {
    return preg_match("#^\+?[0-9./ ]+$#", $value);
});

/**
 * Validation check for names (firstname and/or lastname).
 * Accepts only :
 *  - letters
 *  - apostrophe
 *  - dashes
 */
Validator::extend('names', function($field, $value, $parameters) {
    return preg_match("#^[\p{L}'\- ]+$#u", $value);
});

/**
 * Validation check for file extension.
 * Verify that the checked file's extension is found in the set of provided parameters.
 */
Validator::extend('ext', function($field, $value, $parameters) {
    $ext = $value->getClientOriginalExtension();
    return array_search($ext, $parameters) !== false;
});

/**
 * Validation check for files source.
 * Verify that the checked file's source start with the provided string or any batch of lowercase letters, 
 * followed by a /, 14 numbers, an underscore and end with a dot followed by 3 to 4 lowercase letters.
 */
Validator::extend('path', function($field, $value, $parameters) {
    if (empty($parameters)) {
        $parameters[] = "[a-z]+";
    }
    return preg_match("#^" . $parameters[0] . "\/[0-9]{14}\_.+\.[a-z]{3,4}$#u", $value);
});
