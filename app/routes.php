<?php

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

	Route::get('/trads/{locale?}', 'TranslationController@translate')->where('locale', '[A-Za-z_]+');
	Route::get('/langs', 'TranslationController@index');

	Route::post('/auth/login', 'AuthController@login');
	Route::get('/auth/logout', 'AuthController@logout');


	Route::group(array('before' => ''), function()
	{
		// before auth

		Route::put('/langs', 'TranslationController@setLocale');

		Route::group(array('before' => ''), function()
		{
			// before acl

			Route::resource('artists', 'ArtistController', 
			array('except' => array('create', 'edit')));

			Route::resource('events', 'EventController', 
				array('except' => array('create', 'edit')));

			Route::resource('equipments', 'EquipmentController', 
				array('except' => array('create', 'edit', 'update')));

			Route::resource('event-types', 'EventTypeController', 
				array('except' => array('create', 'edit', 'update')));

			Route::resource('skills', 'SkillController', 
				array('except' => array('create', 'edit', 'update')));

			Route::resource('genres', 'GenreController', 
				array('except' => array('create', 'edit', 'update')));

			Route::resource('gifts', 'GiftController', 
				array('except' => array('create', 'edit', 'update')));

			Route::resource('instruments', 'InstrumentController', 
				array('except' => array('create', 'edit', 'update')));

			Route::resource('printing-types', 'PrintingTypeController', 
				array('except' => array('create', 'edit', 'update')));

			Route::resource('ticket-categories', 'TicketCategoryController', 
				array('except' => array('create', 'edit', 'update')));

			Route::resource('addresses', 'AddresseController', 
				array('except' => array('create', 'edit')));

			Route::resource('lineups', 'LineupController', 
				array('except' => array('create', 'edit', 'update')));

			Route::resource('attributions', 'AttributionController', 
				array('except' => array('create', 'edit')));

			Route::resource('descriptions', 'DescriptionController', 
				array('except' => array('create', 'edit', 'update')));

			Route::resource('needs', 'NeedController', 
				array('except' => array('create', 'edit', 'update')));

			Route::resource('fulfillments', 'FulfillmentController', 
				array('except' => array('create', 'edit', 'update')));

			Route::resource('illustrations', 'IllustrationController', 
				array('except' => array('create', 'edit', 'update')));

			Route::resource('images', 'ImageController', 
				array('except' => array('create', 'edit')));

			Route::resource('links', 'LinkController', 
				array('except' => array('create', 'edit')));

			Route::resource('members', 'MemberController', 
				array('except' => array('create', 'edit')));

			Route::resource('musicians', 'MusicianController', 
				array('except' => array('create', 'edit')));

			Route::resource('offers', 'OfferController', 
				array('except' => array('create', 'edit')));

			Route::resource('performers', 'PerformerController', 
				array('except' => array('create', 'edit')));

			Route::resource('printings', 'PrintingController', 
				array('except' => array('create', 'edit')));

			Route::resource('sharings', 'ScharingController', 
				array('except' => array('create', 'edit', 'update')));

			Route::resource('staffs', 'StaffController', 
				array('except' => array('create', 'edit')));

			Route::resource('symbolizations', 'SymbolizationController', 
				array('except' => array('create', 'edit', 'update')));

			Route::resource('tickets', 'TicketController', 
				array('except' => array('create', 'edit')));

			Route::resource('representers', 'RepresenterController', 
				array('except' => array('create', 'edit')));

			Route::resource('guarantees', 'GuaranteeController', 
				array('except' => array('create', 'edit', 'update')));
		});

	});

});

// catching 404 error

App::missing(function($exception)
{
    return 'error 404';
});