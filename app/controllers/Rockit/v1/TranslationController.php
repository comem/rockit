<?php

namespace Rockit\v1;

use \App,
    \Input,
    \Auth,
    \Jsend,
    \Rockit\Language,
    \User;

/**
 * Contains interaction methods to the Language model in the database.<br>
 * Based on the Laravel's BaseController.<br>
 * Can : <b>index</b> all the Languages, <b>translate</b> to another Language, and <b>changeLocale</b> of the current user to another Language.<br>
 * 
 * @author Joël Gugger <joel.gugger@heig-vd.ch>
 */
class TranslationController extends \BaseController {

    /**
     * Return the collection of possible languages for this application.
     *
     * @return Jsend
     */
    public function index() {
        return Jsend::success(['response' => Language::all()]);
    }

    /**
     * Return the translation for the locale provided.
     *
     * If no locale is provided, the default locale is NULL and a <b>Jsend::success</b> is returned.<br>
     *
     * @param $locale
     * @return Jsend
     */
    public function translate($locale = NULL) {
        if ($locale != NULL) {
            App::setLocale($locale);
        }
        return Jsend::success(['response' => trans('hci')]);
    }

    /**
     * Redefine the current user's new default Language.
     *
     * Get the adequate inputs from the client request and test that the local provided passes the validation rules.<br>
     * If this input fails, a <b>Jsend::fail</b> is returned.<br>
     * If the input is valid, the data is then passed to the <b>setLocale()</b> method.<br>
     * @return Jsend
     */
    public function changeLocale() {
        $inputs = Input::only('locale');
        $validate = Language::validate($inputs, Language::$update_rules);
        if ($validate === true) {
            $response = self::setLocale($inputs['locale']);
        } else {
            $response = $validate;
        }
        return Jsend::compile($response);
    }
    
    /**
     * Set the current user's default Language to the locale provided.
     *
     * If the locale provided does not exist in this application, a <b>Jsend::fail</b> is returned.<br>
     * If the locale provided is valid, the current User's information is updated and the application's language is set.<br>
     *
     * @param $locale
     * @return Jsend
     */
    public static function setLocale($locale) {
        $lang = Language::exist($locale, 'locale');
        if (is_object($lang)) {
            $response = User::updateOne(['language_id' => $lang->id], Auth::user());
            App::setLocale($lang->locale);
            return $response;
        } else {
            return ['fail' => ['locale' => [trans('fail.language.inexistant')]]];
        }
    }

}
