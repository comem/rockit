<?php

/**
 * Validation rules for phone number.
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
 * Validation rules for names.
 * Accepts only :
 *  - letters
 *  - apostrophe
 *  - dashes
 */
Validator::extend('names', function($field, $value, $parameters) {
    return preg_match("#^[\p{L}'\- ]+$#u", $value);
});