<?php

namespace Rockit\v1;

use Facebook\FacebookRedirectLoginHelper,
    Facebook\FacebookSession,
    Facebook\FacebookRequest,
    Facebook\FacebookResponse,
    Facebook\GraphUser,
    Rockit\Sharing,    
    \Facebook,
    \Config,
    \Session,
    \Redirect,
    \Jsend,
    \Input;

class FacebookController extends \BaseController {

    /**
     * This function handles the Facebook login: it directs on fb login mask. 
     * After a successful login of facebook, it redirects on the given url.
     * @return Redirection to redirect url
     */
    public static function login() {
        session_start();

        $redirectUrl = Config::get('facebook.redirecturl'); // will be taken from Database
        $appkey = Config::get('facebook.appkey');
        $secretkey = Config::get('facebook.secretkey');
        $scope = Config::get('facebook.scope');
        FacebookSession::setDefaultApplication($appkey, $secretkey);

        $helper = new FacebookRedirectLoginHelper($redirectUrl);

        Session::set('facebookHelper', $helper);
        $loginUrl = $helper->getLoginUrl($scope);
        return Redirect::to($loginUrl);
    }

    /**
     * This function gets the facebook session.
     */
    public function redirectCatch() {
        session_start();

        $redirectUrl = Config::get('facebook.redirecturl'); // will be taken from Database
        $appkey = Config::get('facebook.appkey');
        $secretkey = Config::get('facebook.secretkey');
        $scope = Config::get('facebook.scope');
        FacebookSession::setDefaultApplication($appkey, $secretkey);

        $helper = new FacebookRedirectLoginHelper($redirectUrl);
        Session::set('facebookHelper', $helper);

        try {
            $session = $helper->getSessionFromRedirect();
            Session::set('facebookSession', $session);
        } catch (FacebookRequestException $ex) {
            die("in error 1");
            // When Facebook returns an error
        } catch (\Exception $ex) {
            die("in error 2");
            // When validation fails or other local issues
        }
        return self::shareEvent(Session::get('fbEventId'));
    }

    public static function shareEvent($event_id) {

//        $request = new FacebookRequest($session, 'GET', '/me');
//        $response = $request->execute();
//        $graphObject = $response->getGraphObject();
//        print_r($graphObject);
//        die();
        $session = Session::get('facebookSession');

        if ($session) {
            try {

                $user_profile = (new FacebookRequest(
                        $session, 'GET', '/me'
                        ))->execute()->getGraphObject(GraphUser::className());
            } catch (FacebookRequestException $e) {
                $response = Jsend::error(trans('error.facebook.userprofile'));
            }
        }
        // check if it is the correct user – cause everyone can log itself,
        // but only the user in config can post automatically
        if (isset($user_profile) && strcasecmp($user_profile->getName(), Config::get('facebook.username')) == 0) {
            ///// CREATE A POST WORKS!
            if ($session) {
                try {
                    $fbResponse = (new FacebookRequest(
                        $session, 'POST', '/me/feed', array(
                        'message' => 'Mein erster, automatisch generierter Eintrag auf Facebook.'
                        )
                        ))->execute()->getGraphObject();
                    $inputs['external_id'] = $fbResponse->getProperty('id');
                    $inputs['url'] = "www.facebook.com";
                    $inputs['platform_id'];
                    $inputs['event_id'] = Session::get('fbEventId');
                    $response = Sharing::createOne($inputs);                    
                } catch (FacebookRequestException $e) {
                    echo "Exception occured, code: " . $e->getCode();
                    echo " with message: " . $e->getMessage();
                }
            }
        } elseif(!isset($response['error'])) {
            $response = Jsend::error(trans('error.facebook.wronguser'));
        }
        return $response;


//// EVENT CREATION IS FORBIDDEN BY FACEBOOK – in v1.0 OF GRAPH API THE METHOD EXISTED
//        if ($session) {
//            try {
//                $response = (new FacebookRequest(
//                        $session, 'POST', '/me/events', array(
//                    "name" => "Das Event des Jahres",
//                    "start_time" => "08/15/2015 22:00",
//                    "end_time" => "08/15/2015 23:00",
//                    "location" => "Zigeunerweg 48, 3000 Bern",
//                    "description" => "Dieser Event wird zwar nie stattfinden, aber egal.",
//                        )
//                        ))->execute()->getGraphObject();
//                echo "Posted with id: " . $response->getProperty('id');
//            } catch (FacebookRequestException $e) {
//                echo "Exception occured, code: " . $e->getCode();
//                echo " with message: " . $e->getMessage();
//            }
//        }

    }
}
