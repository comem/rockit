<?php

class FacebookController {
    
    public static function login() {
        session_start();
        $redirectUrl = Config::get('facebook.redirecturl'); // will be taken from Database
        $appkey = Config::get('facebook.appkey');
        $secretkey = Config::get('facebook.secretkey');
        $scope = Config::get('facebook.scope');
        
        $helper = new FacebookRedirectLoginHelper($redirectUrl, $appkey, $secretkey);
        Session::set('facebookHelper', $helper);
        $loginUrl = $helper->getLoginUrl($scope);
        
        return Redirect::to($loginUrl);
    }
    
    public function facebookRedirect() {
//              $redirectUrl = Config::get('facebook.redirecturl'); // will be taken from Database
//        $appkey = Config::get('facebook.appkey');
//        $secretkey = Config::get('facebook.secretkey'); 
//        
//        $helper = new FacebookRedirectLoginHelper($redirectUrl, $appkey, $secretkey);
        $helper = Session::get('facebookHelper');
        try {
            $session = $helper->getSessionFromRedirect();
        } catch (FacebookRequestException $ex) {
            // When Facebook returns an error
        } catch (\Exception $ex) {
            // When validation fails or other local issues
        }
        if ($session) {
            print_r("in session, yes");
            die();
        }
    }
    
}