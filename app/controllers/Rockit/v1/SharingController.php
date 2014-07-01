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
     * the asked post/entry on the indicated platform. Needs a platform_id, an event_id and
     * can have an additional_text.
     * @return Response a fail if given data is not valid or redirect on facebook login.
     */
    public function store() {
        $inputs = Input::only('platform_id', 'event_id', 'additional_text');
        $v = Validator::make($inputs, Sharing::$create_rules);
        if ($v->fails()) {
            $response['fail'] = $v->messages()->getMessages();
        } else {
            $event = Event::find($inputs['event_id']);
            if (!is_null($event->published_at)) {
                Session::set('event_id', $inputs['event_id']);
                Session::set('platform_id', $inputs['platform_id']);
                Session::set('additional_text', $inputs['additional_text']);
                $platform = Platform::find($inputs['platform_id']);
                // from here on, test if platform name correspond to create entrys.
                if (strcasecmp($platform->name, "facebook") == 0) {
                    Session::set('fb_share', true);
                    Session::set('fb_delete', false);
                    return FacebookController::login();
                } else {
                    $response['fail'] = ['sharing' => [trans('fail.sharing.no_platform')]];
                }
            } else {
                $response['fail'] = ['event' => [trans('fail.event.is_not_published')]];
            }
        }
        return Jsend::compile($response);
    }

    /**
     * Remove the specified resource from storage and removes also the
     * linked post if possible.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $sharing = Sharing::find($id);
        if (!is_null($sharing)) {
            $platform = $sharing->platform;
            Session::set('sharing', $sharing);
            Session::set('external_id', $sharing->external_id);
            if (strcasecmp($platform->name, "facebook") == 0) {
                Session::set('fb_share', false);
                Session::set('fb_delete', true);
                return FacebookController::login();
            } else {
                $response['fail'] = ['sharing' => [trans('fail.sharing.no_platform')]];
            }
        } else {
            $response['fail'] = ['sharing' => [trans('fail.sharing.inexistant')]];
        }
        return Jsend::compile($response);
    }

}
