<?php

namespace Rockit\v1;

use \Config,
    \Redirect,
    \Session,
    \Input,
    \Jsend,
    \Validator,
    Rockit\Event,
    Rockit\Platform,
    Rockit\Sharing,
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
        $v = Validator::make($inputs, Sharing::$create_rules);
        if($v->fails()) {
            $response['fail'] = $v->messages()->getMessages();
        } else {
            Session::set('event_id', $inputs['event_id']);
            Session::set('platform_id', $inputs['platform_id']);
            Session::set('additional_text', $inputs['additional_text']);
            $platform = Platform::find($inputs['platform_id']);
            // from here on, test if platform name correspond to create entrys.
            if(strcasecmp($platform->name, "facebook") == 0) {
                return FacebookController::login();
            }
        }
        return $response;
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
