<?php

namespace Rockit\v1;

use Illuminate\Support\Facades\Input,
    \User,
    \Auth,
    \Jsend;

class AuthController extends \BaseController {

    /**
     * Login the current user. Checks if email and password are set, if they are valid
     * following User Model, then try to log in.
     *
     * @return Jsend success or Jsend fail
     */
    public function login() {
        // test if remember is set true
        $remember = Input::get('remember');
        if (!empty($remember)) {
            $remember = $remember == 'true' ? true : false;
        }
        $credentials = [
            'email' => Input::get('email'),
            'password' => Input::get('password')
        ];
        if (($credentials['email'] != null && $credentials['password'] != null) &&
        User::validate(array($credentials['email'], $credentials['password'])) &&
        Auth::attempt($credentials, $remember, true)) {
            return Jsend::success(array(
                'title' => trans('success.auth.login'),
                'user' => Auth::user(),
            ));
        }
        return Jsend::error(trans('error.auth.login'));
    }

    /**
     * Logout the current user.
     * @return Jsend success or Jsend fail
     */
    public function logout() {
        try {
            Auth::logout();
        } catch (Exception $e) {
            Jsend::error(trans('error.auth.logout'));
        }
        return Jsend::success(array('title' => trans('success.auth.logout')));
    }
    
    /**
     * Check wether the current user is logged in the application.
     * @return boolean
     */
    public function authCheck() {
        return Auth::guest() ? Jsend::fail(null) : Jsend::success();
    }

}
