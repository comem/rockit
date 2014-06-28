<?php

namespace Rockit\v1;

use \App,
    \Input,
    \Auth,
    \Jsend,
    \Rockit\Language,
    \User;

class TranslationController extends \BaseController {

    /**
     * Return the collection of langs possible
     *
     * @return Response
     */
    public function index() {
        return Jsend::success(['response' => Language::all()]);
    }

    /**
     * Return the translation in the locale
     *
     * @return Response
     */
    public function translate($locale = NULL) {
        if ($locale != NULL) {
            App::setLocale($locale);
        }
        //return Jsend::success(trans('ihm'));
        return Jsend::success(['response' => trans('hci')]);
    }

    /**
     * Define the new default locale for the Auth::user()
     *
     * @return Response
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

    public static function setLocale($locale) {
        $lang = Language::exist($locale, 'locale');
        if (is_object($lang)) {
            $response = User::updateOne(['language_id' => $lang->id], Auth::user());
            App::setLocale($lang->locale);
            return $response;
        } else {
            return ['fail' => [trans('fail.language.inexistant')]];
        }
    }

}
