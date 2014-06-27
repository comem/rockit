<?php

use Artdarek\OAuth\OAuth,
    Symfony\Component\Security\Core\User\User;

namespace Rockit\v1;

class FbAuthController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getLogin() {
       return View::make('auth.login');
    }

    public function postCheck() {
        if (Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password')))) {
            return Redirect::intended('private');
        } else {
            Session::flash('message', 'Login et/ou mot de passe incorrect !');
            return Redirect::to(URL::action('AuthController@getLogin'));
        }
    }

    public function getFacebookAuth() {
        $redirect = sprintf(
                Config::get('oauth.facebook.login.action'), Config::get('oauth.facebook.client.id'), URL::action('AuthController@getCheckFacebookAuth')
        );
        return Redirect::to($redirect);
    }

    public function getCheckFacebookAuth() {
        if (Input::get('error') == 'access_denied') {
            return Redirect::to(URL::action('AuthController@getAuthError'));
        } else {

            $redirect = sprintf(
                    Config::get('oauth.facebook.get.access.token'), Config::get('oauth.facebook.client.id'), URL::action('AuthController@getCheckFacebookAuth'), Config::get('oauth.facebook.client.secret'), Input::get('code')
            );
            $token = file_get_contents($redirect);
            $user_fb = json_decode(file_get_contents(sprintf(
                                    Config::get('oauth.facebook.get.user'), $token
            )));
            Eloquent::unguard();
            $user = User::firstOrCreate(array(
                        'username' => $user_fb->username,
                        'password' => 'shadow',
                        'name' => $user_fb->nme,
                        'email' => $user_fb->email
                        
            ));
            Auth::login($user);
            return Redirect::to(URL::action('SalonController@getHome'));
            
        }
    }

    public function getLoginFacebookAuth() {

        return View::make('auth.error');
    }

    public function getAuthError() {
        return View::make('auth.error');
    }

    public function getLogout() {
        Auth::logout();
        return Redirect::action('AuthController@getLogin');
    }

}