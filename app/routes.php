<?php

use Rockit\Group;

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */

Route::get('/', function() {
    return View::make('hello');
});

Route::group(array('before' => 'acl'), function() {
    Route::resource('artists', 'ArtistController', array('except' => 'create', 'edit'));
});

Route::get('test', function() {
    $controller = 'ArtistController';
    $method = 'index';
    return Group::where('name', '=', 'Managers')->first()->hasAccess($controller, $method);
});
