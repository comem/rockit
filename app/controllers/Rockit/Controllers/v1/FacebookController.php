<?php

namespace Rockit\Controllers\v1;

use Rockit\Helpers\Jsend,
    \Session,
    \Redirect,
    \Rockit\Models\Event,
    \Rockit\Models\Platform,
    \Rockit\Models\Sharing,
    Facebook\GraphUser,
    Facebook\FacebookRequestException,
    Facebook\FacebookRequest,
    Facebook\FacebookSession,
    Facebook\FacebookRedirectLoginHelper;

class FacebookController extends \BaseController {

    /**
     * This function handles the Facebook login: it directs on fb login mask. 
     * After a successful login of facebook, it redirects on the given url (taken from database).
     * @return Redirection to redirect_url
     */
    public static function login() {
        session_start();

        $platform = Platform::where('name', '=', 'facebook')->first();
        $secretkey = $platform->client_secret;
        $api_infos = json_decode($platform->api_infos);
        $redirectUrl = $api_infos->redirect_url;
        $appkey = $api_infos->appkey;
        $scope = $api_infos->scope;
        FacebookSession::setDefaultApplication($appkey, $secretkey);

        $helper = new FacebookRedirectLoginHelper($redirectUrl);

        Session::set('facebookHelper', $helper);
        $loginUrl = $helper->getLoginUrl($scope);
        return Redirect::to($loginUrl);
    }

    /**
     * This function catches the facebook session which is returned from
     * a facebook login call.
     * @author Christian Heimann <christian.heimann@heig-vd.ch>
     */
    public function redirectCatch() {
        session_start();

        $platform = Platform::where('name', '=', 'facebook')->first();
        $secretkey = $platform->client_secret;
        $api_infos = json_decode($platform->api_infos);
        $redirectUrl = $api_infos->redirect_url;
        $appkey = $api_infos->appkey;
        FacebookSession::setDefaultApplication($appkey, $secretkey);

        $helper = new FacebookRedirectLoginHelper($redirectUrl);
        Session::set('facebookHelper', $helper);

        try {
            $session = $helper->getSessionFromRedirect();
            Session::set('facebookSession', $session);
        } catch (FacebookRequestException $ex) {
            $response['error'] = $ex->getMessage();
            // When Facebook returns an error
        } catch (\Exception $ex) {
            $response['error'] = $ex->getMessage();
            // When validation fails or other local issues
        }
        if (isset($response['error'])) {
            return $response;
        }
        if (Session::get('fb_share')) {
            return Jsend::compile(self::shareEvent());
        } elseif (Session::get('fb_delete')) {
            return Jsend::compile(self::deleteEvent());
        } else {
            return Jsend::error(trans('error.facebook.no_action'));
        }
    }

    /**
     * Function to create a Facebook Post to share the data of a given event with an automatically
     * created message. If the creation of a post succeeds, the Sharing entry is made
     * into database.
     * @return $response with success or error
     * @author Christian Heimann <christian.heimann@heig-vd.ch>
     */
    private static function shareEvent() {
        $session = Session::get('facebookSession');
        $event_id = Session::get('event_id');
        $platform = Platform::where('name', '=', 'facebook')->first();
        $api_infos = json_decode($platform->api_infos);

        $additional_text = Session::get('additional_text');
        if (is_null($additional_text)) {
            $additional_text = "";
        }
        $event = Event::find($event_id);
        if (!is_null($event)) {
            $message = Sharing::message($event, $additional_text);
            if ($session) {
                try {
                    $user_profile = (new FacebookRequest(
                    $session, 'GET', '/me'
                    ))->execute()->getGraphObject(GraphUser::className());
                } catch (FacebookRequestException $e) {
                    $response['error'] = trans('error.facebook.userprofile');
                }
            }
            // check if it is the correct user – cause everyone can log itself,
            // but only the user in config can delete post automatically
            if (isset($user_profile) && strcasecmp($user_profile->getName(), $api_infos->username) == 0) {
                // create a post
                if ($session) {
                    try {
                        $fbResponse = (new FacebookRequest(
                        $session, 'POST', '/me/feed', array(
                            'message' => $message,
                            'place' => $api_infos->place_id,
                            'link' => $api_infos->link,
                        )
                        ))->execute()->getGraphObject();
                    } catch (FacebookRequestException $e) {
                        $response['error'] = "Exception occured, code: " . $e->getCode() . " with message: " . $e->getMessage();
                    }
                    // if no error occured, set inputs for creation of a new sharing
                    if (!isset($response['error'])) {
                        $inputs['external_id'] = $fbResponse->getProperty('id');
                        $inputs['url'] = "www.facebook.com";
                        $inputs['platform_id'] = Session::get('platform_id');
                        $inputs['event_id'] = Session::get('event_id');
                        $inputs['external_infos'] = json_encode(['additional_text' => $additional_text]);
                        $response = Sharing::createOne($inputs);
                    }
                }
            } elseif (!isset($response['error'])) {
                $response['error'] = trans('error.facebook.wrong_user');
            }
        } else {
            $response['fail'] = [
                'event' => trans('fail.event.inexistant'),
            ];
        }
        return $response;
    }

    /**
     * Function to delete a post of an event. Facebook session and the sharing object
     * must already be set as Session variable. If a post cannot be found on facebook,
     * the database entry is deleted anyway.
     * @return Response
     * @author Christian Heimann <christian.heimann@heig-vd.ch>
     */
    private static function deleteEvent() {
        $session = Session::get('facebookSession');
        $sharing = Session::get('sharing');
        $platform = Platform::where('name', '=', 'facebook')->first();
        $api_infos = json_decode($platform->api_infos);

        if (!is_null($sharing)) {
            if ($session) {
                try {
                    $user_profile = (new FacebookRequest(
                    $session, 'GET', '/me'
                    ))->execute()->getGraphObject(GraphUser::className());
                } catch (FacebookRequestException $e) {
                    $response['error'] = "Exception occured, code: " . $e->getCode() . " with message: " . $e->getMessage();
                }
            }
            if (isset($user_profile) && strcasecmp($user_profile->getName(), $api_infos->username) == 0) {
                // delete a post
                if ($session) {
                    try {
                        $fbResponse = (new FacebookRequest(
                        $session, 'DELETE', '/' . $sharing->external_id))->execute()->getGraphObject();
                    } catch (FacebookRequestException $e) {
                        $response['error'] = "Exception occured, code: " . $e->getCode() . " with message: " . $e->getMessage();
                    }
                    $sharing = Session::get('sharing');
                    $response = Sharing::deleteOne($sharing);
                    if (isset($response['success'])) {
                        unset($response['error']);
                    }
                }
            }
        } else {
            $response['error'] = ['sharing' => [trans('error.app'), ['code' => "No Sharing recieved."]]];
        }
        return $response;
    }

}
