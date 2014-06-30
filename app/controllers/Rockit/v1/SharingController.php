<?php

namespace Rockit\v1;

use \Config,
    \Redirect,
    \Session,
    \Input,
    \Jsend,
    Rockit\Event,
    Rockit\Platform,
    Rockit\v1\FacebookController;

//include_once("facebook-php-sdk/src/facebook.php");


class SharingController extends \BaseController {

    /**
     * Store a newly created resource in storage, and creates automatically
     * the asked post.

     *
     * @return Response
     */
    public function store() {
        $inputs = Input::only('platform_id', 'event_id', 'additional_text');
        if(isset($inputs['platform_id']) && isset($inputs['event_id'])) {
            $event = Event::find($inputs['event_id']);

            if (!isset($event)) {
               return $response = Jsend::fail(array('title' => trans('fail.sharing.eventidnotvalid')));
            }
            $platform = Platform::find($inputs['platform_id']);
            if(!isset($platform)) {
                return $response = Jsend::fail(array('title' => trans('fail.sharing.platformidnotvalid')));
            }
            Session::set('event_id', $inputs['event_id']);
            Session::set('platform_id', $inputs['platform_id']);
            Session::set('additional_text', $inputs['additional_text']);
            // from here on, test if platform name correspond to create entrys.
            if(strcasecmp($platform->name, "facebook") == 0) {
                return FacebookController::login();
            }
        } else {
            $response['fail'] = trans('fail.sharing.missinginput');
        }
        return $response;

//  $inputs = Input::only('event_id');

//        $platform = Platform::where('name', '=', 'facebook')->first();
//        $inputs['platform_id'] = $platform->id;
//        
//        
//        $inputs = Input::only('name', 'access_token', 'start_time', 'end_time', 'location', 'description');
//
//        $fileName = "public/images/mahogany-pos.jpg"; //profile picture of the event
//
//        $fb = new Facebook(array(
//            'appId' => FACEBOOOK_API_KEY,
//            'secret' => FACEBOOK_SECRET_KEY,
//            'cookie' => false,
//            'fileUpload' => true // this is important !
//        ));
//
//        $fb->setAccessToken($inputs['access_token']);
//
//        $data = array("name" => $inputs['name'],
//            "access_token" => $inputs['access_token'],
//            "start_time" => $inputs['start_time'],
//            "end_time" => $inputs['end_time'],
//            "location" => $inputs['location'],
//            "description" => $inputs['description'],
//            basename($fileName) => '@' . $fileName
//        );
//        try {
//            $result = $fb->api("/me/events", "post", $data);
//            $facebookEventId = $result['id'];
//            echo $facebookEventId;
//        } catch (Exception $e) {
//            echo "0";
//        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
