<?php

use Rockit\Models\Resource,
    Rockit\Helpers\Jsend;

/*
  |--------------------------------------------------------------------------
  | Application & Route Filters
  |--------------------------------------------------------------------------
  |
  | Below you will find the "before" and "after" events for the application
  | which may be used to do any work before or after a request into your
  | application. Here you may also register your custom route filters.
  |
 */

App::before(function($request) {
    // Check the current locale and set it to the user's locale
    if (!Auth::guest() && App::getLocale() !== Auth::user()->language->locale) {
        App::setLocale(Auth::user()->language->locale);
    }
});


App::after(function($request, $response) {
    //
});

/*
  |--------------------------------------------------------------------------
  | Authentication Filters
  |--------------------------------------------------------------------------
  |
  | The following filters are used to verify that the user of the current
  | session is logged into this application. The "basic" filter easily
  | integrates HTTP Basic authentication for quick, simple checking.
  |
 */

Route::filter('auth', function() {
    if (Auth::guest()) {
        return Jsend::fail(['auth' => [trans('fail.auth')]]);
    }
});


Route::filter('auth.basic', function() {
    return Auth::basic();
});

/*
  |--------------------------------------------------------------------------
  | Guest Filter
  |--------------------------------------------------------------------------
  |
  | The "guest" filter is the counterpart of the authentication filters as
  | it simply checks that the current user is not logged in. A redirect
  | response will be issued if they are, which you may freely change.
  |
 */

Route::filter('guest', function() {
    if (Auth::check())
        return Redirect::to('/');
});

/*
  |--------------------------------------------------------------------------
  | CSRF Protection Filter
  |--------------------------------------------------------------------------
  |
  | The CSRF filter is responsible for protecting your application against
  | cross-site request forgery attacks. If this special token in a user
  | session does not match the one given in this request, we'll bail.
  |
 */

Route::filter('csrf', function() {
    if (Session::token() != Input::get('_token')) {
        throw new Illuminate\Session\TokenMismatchException;
    }
});

/*
  |--------------------------------------------------------------------------
  | ACL Filter
  |--------------------------------------------------------------------------
  |
  | The ACL filter is responsible for checking if a user has the right accesses
  | to the action he wants to perform.
  |
 */

Route::filter('acl', function() {
    $routeInfo = Str::parseCallback(Route::currentRouteAction(), null);
    //dd($routeInfo);
    $controller = class_basename($routeInfo[0]);
    //dd($controller);
    $method = $routeInfo[1];
    //dd($method);
    $resource = Resource::where('controller', '=', $controller)
    ->where('method', '=', $method)
    ->first();
    if (empty($resource) || !Auth::user()->hasAccess($resource)) {
        return Jsend::fail(['acl' => [trans('fail.acl')]]);
    }
});
