<?php

namespace Rockit\Controllers\v1;

use \Session,
    \Input,
    Rockit\Helpers\Jsend,
    \Validator,
    \Rockit\Models\Event,
    \Rockit\Models\Platform,
    \Rockit\Models\Sharing,
    \Rockit\Controllers\v1\FacebookController;

//include_once("facebook-php-sdk/src/facebook.php");

/**
 * A Sharing is the link between an Event and a Platform.<br>
 * Contains interaction methods for the relationship between a Platform and the Event it shares.<br>
 * Based on the Laravel's BaseController.<br>
 * Can : <b>store</b> and <b>destroy</b> an association between a Platform and an Event.<br>
 * 
 * @author Christian Heimann <christian.heimann@heig-vd.ch>
 */
class SharingController extends \BaseController {

    /**
     * Store a new association between a Platform and the Event it shares. Currently facebook is the only Platform implemented.
     * 
     * Get the adequate inputs from the client request and test that each of them pass the validation rules.<br>
     * If any of these inputs fails, a <b>Jsend::fail</b> is returned.<br>
     * If the Event provided is not published, a <b>Jsend::fail</b> is returned.<br>
     * If the Platform provided is not recognized, a <b>Jsend::error</b> is returned.<br>
     * If the association between the Event and the Platform was created, then return a redirection to the Platform's login page.<br>
     *
     * @return Jsend or a redirect to the Platform's login
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
                    $response['error'] = trans('error.sharing.no_platform');
                }
            } else {
                $response['fail'] = ['event' => [trans('fail.event.is_not_published')]];
            }
        }
        return Jsend::compile($response);
    }

    /**
     * Destroy the association between a Platform and an Event, from the provided Sharing id.
     *
     * If the sharing id does not point to an existing Sharing, a <b>Jsend::fail</b> is returned.<br>
     * If the Platform provided is not recognized, a <b>Jsend::error</b> is returned.<br>
     * If the Sharing was deleted, then return a redirection to the Platform's login page.<br>
     * Also removes the linked post if it is possible.
     * 
     * @param int $id The id of the Sharing that will no longer share the Event
     * @return Jsend
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
                $response['error'] = trans('error.sharing.no_platform');
            }
        } else {
            $response['fail'] = ['sharing' => [trans('fail.sharing.inexistant')]];
        }
        return Jsend::compile($response);
    }

}
