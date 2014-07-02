<?php

namespace Rockit\Controllers\v1;

use Rockit\Helpers\Jsend,
    \User,
    \Auth,
    Illuminate\Support\Facades\Input;

class AuthController extends \BaseController {

    /**
     * Login the current user if he provides valid credentials. 
     *
     * Get the adequate inputs from the client request and attempt a login.<br>
     * If an email and password were not provided, a <b>Jsend::error</b> is returned.<br>
     * If the email and/or password aren't in the valid forms, a <b>Jsend::error</b> is returned.<br>
     * If the email and/or password provided were not valid credentials, a <b>Jsend::error</b> is returned.<br>
     *
     * @return Jsend success or Jsend fail
     * @author Christian Heimann <chritian.heimann@heig-vd.ch>
     */
    public function login() {
        $remember = Input::get('remember');
        if (!empty($remember)) {
            $remember = $remember == 'true' ? true : false;
        }
        $credentials = [
            'email' => Input::get('email'),
            'password' => Input::get('password')
        ];
        if (($credentials['email'] != null && $credentials['password'] != null) && Auth::validate($credentials)) {
            if (Auth::attempt($credentials, $remember, true)) {
                $response['success'] = ['response' => [
                        'title' => trans('success.auth.login'),
                        'user' => Auth::user(),
                ]];
            } else {
                $response['error'] = trans('error.auth.login');
            }
        } else {
            $response['fail'] = ['auth' => [trans('fail.auth.login')]];
        }
        return Jsend::compile($response);
//        if (($credentials['email'] != null && $credentials['password'] != null) &&
//        User::validate(array($credentials['email'], $credentials['password'])) &&
//        Auth::attempt($credentials, $remember, true)) {
//            return Jsend::success(['response' => [
//                'title' => trans('success.auth.login'),
//                'user' => Auth::user(),
//            ]]);
//        }
//        return Jsend::error(trans('error.auth.login'));
    }

    /**
     * Login the current user if he provides valid credentials. 
     *
     * Get the adequate inputs from the client request and attempt a login.<br>
     * If an email and password were not provided, a <b>Jsend::error</b> is returned.<br>
     * If the email and/or password aren't in the valid forms, the same <b>Jsend::error</b> is returned.<br>
     * If the email and/or password provided were not valid credentials, the same <b>Jsend::error</b> is returned.<br>
     * TO REVIEW
     * @return array Contains an array with either a <b>error</b> or a <b>success</b> key and its corresponding message
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
     * Check whether the current user is logged in to the application.
     * @return boolean <b>Jsend::fail</b> or <b>Jsend::success</b>
     */
    public function authCheck() {
        return Auth::guest() ? Jsend::fail(null) : Jsend::success();
    }

}
