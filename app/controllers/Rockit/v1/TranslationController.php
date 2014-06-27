<?php

namespace Rockit\v1;

use \App,
    \Input,
    \Auth,
    \Jsend,
    \Rockit\Language,
    \User;

/**
 * Contains interaction methods to the Musician model in the database.<br>
 * Based on the Laravel's BaseController.<br>
 * Can : <b>index</b> all the Musicians, <b>store</b>, <b>show</b>, <b>destroy</b> and <b>update</b> one Musician.<br>
 * Since Musicians can be linked to an event, the <b>delete</b> is actually a <b>softDelete</b>.
 * 
 * @author Christian Heimann <christian.heimann@heig-vd.ch>
 */
class TranslationController extends \BaseController {

    /**
     * Return the collection of possible languages for this application.
     *
     * @return Jsend
     */
    public function index() {
        return Jsend::success(Language::all()->toArray());
    }

    /**
     * Return the translation for the locale provided.
     *
     * @param $locale
     * @return Jsend
     */
    public function translate($locale = NULL) {
        if ($locale != NULL) {
            App::setLocale($locale);
        }
        return Jsend::success(trans('ihm'));
    }

    /**
     * Define the new default locale for the Auth::user()
     *
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
     * 
     * @param $locale
     * @return ??
     */
    public static function setLocale($locale) {
        $lang = Language::exist($locale);
        if (is_object($lang)) {
            $response = User::updateOne(
            array('language_id' => $lang->id), Auth::user()
            );
            App::setLocale($lang->locale);
            return $response;
        } else {
            return $lang;
        }
    }

}
