<?php

Event::listen('auth.login', function($user) { 
//    $user = User::where('email', '=', $credentials['email'])->first();
//    $dt = Carbon\Carbon::now();
//    $dts = $dt->toDateTimeString();
//    $user->last_login = $dts;
    $user->last_login = new DateTime;
    $user->save();
   // App::setLocale($user->hasOne('language'));
});

Event::listen('auth.logout', function() {
    Cookie::forget('laravel_session');
});