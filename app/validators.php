<?php

/**
 * Validation rules for phone number. Accepts only numbers, "+" sign and white spaces.
 */
Validator::extend('phone', function($field, $value, $parameters) {
    // return preg_match("#\p{Nd}#u", $value);
    return preg_match("#^[0-9+ ]+$#", $value);
});

/**
 * Validation rules for names. Accepts only letters, apostrophe and dashes.
 */
Validator::extend('names', function($field, $value, $parameters) {
    return preg_match("#\p{L}#u", $value);
});