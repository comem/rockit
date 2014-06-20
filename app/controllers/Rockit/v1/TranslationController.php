<?php

namespace Rockit\v1;

use \App, \Lang, \Input, \Auth, \Jsend;
use \Rockit\Language;

class TranslationController extends \BaseController {

	/**
	 * Return the collection of langs possible
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Return the translation in the locale
	 *
	 * @return Response
	 */
	public function translate($locale = NULL)
	{
		if($locale != NULL) App::setLocale($locale);
		return Lang::get('ihm');
	}

	/**
	 * Define the new default locale for the Auth::user()
	 *
	 * @return Response
	 */
	public function changeLocale()
	{
		$inputs = Input::only('locale');
		$validate = Language::validate( $inputs, Language::$update_rules );
		if( $validate === true ){
			$response = self::setLocale( $inputs['locale'] );
		} else {
			$response = $validate;
		}
		return Jsend::compile($response);
	}

	public static function setLocale( $locale )
	{
		$lang = Language::exist( $locale );
		if( is_object( $lang ) ) {
			$response = User::updateOne(
				array('language_id' => $lang->id),
				Auth::user()
			);
			App::setLocale( $locale->locale );
			return $response;
		} else {
			return $lang;
		}
	}

}
