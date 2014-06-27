<?php

namespace Rockit\v1;

use Facebook\FacebookRedirectLoginHelper;

//include_once("facebook-php-sdk/src/facebook.php");


class SharingController extends \BaseController {

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $redirectURL = "http://localhost:8000/sharings/redirect";
        $helper = new FacebookRedirectLoginHelper($redirectURL);
        $loginUrl = $helper->getLoginUrl();
        
        
        

        define('FACEBOOOK_API_KEY', '836331943057445'); // to be put into config file at end of development
        define('FACEBOOK_SECRET_KEY', 'd381b2204500c4c6c1e8510c303c599d'); // to be put into config file at end of development
        $inputs = Input::only('name', 'access_token', 'start_time', 'end_time', 'location', 'description');

        $fileName = "public/images/mahogany-pos.jpg"; //profile picture of the event

        $fb = new Facebook(array(
            'appId' => FACEBOOOK_API_KEY,
            'secret' => FACEBOOK_SECRET_KEY,
            'cookie' => false,
            'fileUpload' => true // this is important !
        ));

        $fb->setAccessToken($inputs['access_token']);

        $data = array("name" => $inputs['name'],
            "access_token" => $inputs['access_token'],
            "start_time" => $inputs['start_time'],
            "end_time" => $inputs['end_time'],
            "location" => $inputs['location'],
            "description" => $inputs['description'],
            basename($fileName) => '@' . $fileName
        );
        try {
            $result = $fb->api("/me/events", "post", $data);
            $facebookEventId = $result['id'];
            echo $facebookEventId;
        } catch (Exception $e) {
            echo "0";
        }
        die("end");
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
