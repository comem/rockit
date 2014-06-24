<?php

/**
 * Action performed when a user is successfuly logged in.
 * Set his last_login attribute to now and set the app locale to the user locale.
 */
Event::listen('auth.login', function($credentials) { 
    $user = User::where('email', '=', $credentials['email'])->first();
    $dt = Carbon\Carbon::now();
    $dts = $dt->toDateTimeString();
    $user->last_login = $dts;
    $user->save();
    $lang = $user->language->locale;
    App::setLocale($lang);
});

/**
 * Action performed when a user is successfuly logged out.
 * Destroy his session cookie.
 */
Event::listen('auth.logout', function() {
    Cookie::forget('laravel_session');
});