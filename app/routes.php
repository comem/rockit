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
    Route::resource('artists', 'Artistontroller', array('except' => 'create', 'edit'));
});

Route::get('test', function() {
    $controller = 'ArtistController';
    $method = 'index';
    $resource = \Rockit\Resource::where('controller', '=', $controller)
    ->where('method', '=', $method)
    ->first();
    $result = Group::where('name', '=', 'Managers')->first()->hasAccess($resource);
    echo "<pre>";
    var_dump($result);
    echo "</pre>";
});

Route::get('a', function() {
    return Group::where('name', '=', 'Managers')->first()->hasAccess(\Rockit\Resource::where('controller', '=', 'EventController')->where('controller', '=', 'publish'));
});
