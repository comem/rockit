<?php

namespace Rockit\v1;

use \Config,
    \Redirect,    
    \Session,
    \Input,
    \Jsend,
    Rockit\v1\FacebookController;

//include_once("facebook-php-sdk/src/facebook.php");


class SharingController extends \BaseController {

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
      /*
       * $inputs = Input::only('platform_id', 'event_id');
       * if Facebook so …
       */
       $inputs = Input::only('eventId');
       $event = Event::find($inputs['eventId']);
       if(!isset($event)) {
           return $response = Jsend::fail(array('title' => trans('fail.sharing.eventnotvalid')));
       }
       $platform = Platform::where('name', '=', 'facebook')->first();
       $inputs['platformId'] = $platform->id;
       Session::set('fbEventId', $inputs['eventId']);
       Session::set('plattformId', $inputs['platformId']);
       return FacebookController::login();
        
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
