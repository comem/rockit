<?php

Event::listen('auth.login', function($credentials) { 
    $user = User::where('email', '=', $credentials['email'])->first();
    $dt = Carbon\Carbon::now();
    $dts = $dt->toDateTimeString();
    $user->last_login = $dts;
    $user->save();
    $lang = $user->language->locale;
    App::setLocale($lang);
});

Event::listen('auth.logout', function() {
    Cookie::forget('laravel_session');
});