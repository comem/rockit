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

Route::group(array('namespace' => 'Rockit\v1', 'prefix' => 'v1'), function()
{
	
	Route::get('/', function() {
	    return View::make('hello');
	});

	// start

	Route::get('trads/{locale?}', 'TranslationController@translate')->where('locale', '[a-z]+');
	Route::get('langs', 'TranslationController@index');

	Route::post('login', 'AuthController@login');
	Route::get('logout', 'AuthController@logout');
        Route::get('auth-check', 'AuthController@authCheck');
        
        Route::get('download', 'FilesManager@download');

	Route::group(array('before' => 'auth'), function()
	{
		// before auth

		Route::put('langs', 'TranslationController@changeLocale');
                
		Route::group(array('before' => 'acl'), function()
		{
			// before acl
                    
                        Route::get('upload', 'Files@upload');

			Route::resource('artists', 'ArtistController', 
				array('only' => array('index', 'show', 'store', 'update', 'destroy')));

			Route::put('events/{id}/publish', 'EventController@publish')->where('id', '[0-9]+');
			Route::put('events/{id}/unpublish', 'EventController@unpublish')->where('id', '[0-9]+');
			Route::get('events/export/word', 'EventController@exportWord');
			Route::get('events/export/xml', 'EventController@exportXML');
			Route::resource('events', 'EventController', 
				array('only' => array('index', 'show', 'store', 'update', 'destroy')));

			Route::resource('equipments', 'EquipmentController', 
				array('only' => array('index', 'store', 'destroy')));

			Route::resource('event-types', 'EventTypeController', 
				array('only' => array('index', 'store', 'destroy')));

			Route::resource('skills', 'SkillController', 
				array('only' => array('index', 'store', 'destroy')));

			Route::resource('genres', 'GenreController', 
				array('only' => array('index', 'store', 'destroy')));

			Route::resource('gifts', 'GiftController', 
				array('only' => array('index', 'store', 'destroy')));

			Route::resource('instruments', 'InstrumentController', 
				array('only' => array('index', 'store', 'destroy')));

			Route::resource('printing-types', 'PrintingTypeController', 
				array('only' => array('index', 'store', 'destroy')));

			Route::resource('ticket-categories', 'TicketCategoryController', 
				array('only' => array('index', 'store', 'destroy')));

			Route::resource('lineups', 'LineupController', 
				array('only' => array('store', 'destroy')));

			Route::resource('attributions', 'AttributionController', 
				array('only' => array('store', 'update', 'destroy')));

			Route::resource('descriptions', 'DescriptionController', 
				array('only' => array('store', 'destroy')));

			Route::resource('needs', 'NeedController', 
				array('only' => array('store', 'update', 'destroy')));

			Route::resource('fulfillments', 'FulfillmentController', 
				array('only' => array('store', 'destroy')));

			Route::resource('illustrations', 'IllustrationController', 
				array('only' => array('store', 'destroy')));

			Route::resource('images', 'ImageController', 
				array('only' => array('index', 'show', 'store', 'update', 'destroy')));

			Route::resource('links', 'LinkController', 
				array('only' => array('store', 'update', 'destroy')));

			Route::resource('members', 'MemberController', 
				array('only' => array('index', 'show', 'store', 'update', 'destroy')));

			Route::resource('musicians', 'MusicianController', 
				array('only' => array('index', 'show', 'store', 'update', 'destroy')));

			Route::resource('offers', 'OfferController', 
				array('only' => array('store', 'update', 'destroy')));

			Route::resource('performers', 'PerformerController', 
				array('only' => array('store', 'update', 'destroy')));

			Route::resource('printings', 'PrintingController', 
				array('only' => array('store', 'update', 'destroy')));

			Route::resource('sharings', 'ScharingController', 
				array('only' => array('store', 'destroy')));

			Route::resource('staffs', 'StaffController', 
				array('only' => array('store', 'update', 'destroy')));

			Route::resource('symbolizations', 'SymbolizationController', 
				array('only' => array('store', 'destroy')));

			Route::resource('tickets', 'TicketController', 
				array('only' => array('store', 'update', 'destroy')));

			Route::resource('guarantees', 'GuaranteeController', 
				array('only' => array('store', 'destroy')));

			Route::resource('representers', 'RepresenterController', 
				array('only' => array('index', 'show', 'store', 'update', 'destroy')));

		});

	});

});

// catching 404 error

App::missing(function($exception)
{
    return Jsend::fail('fail.routes.missing');
});
