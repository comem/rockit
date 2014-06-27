<?php

namespace Rockit\v1;

use \Jsend,
    \Input,
    Rockit\Member,
    Rockit\Controllers\ControllerBSUDTrait;

class MemberController extends \BaseController {

    use ControllerBSUDTrait;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return Jsend::success(Member::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $model = Member::with('staffs.event', 'staffs.skill', 'fulfillments.skill')->find($id);
        if (is_object($model)) {
            $response = Jsend::success(['member' => $model]);
        } else {
            $response = Jsend::fail(['member' => [trans('fail.member.inexistant')]]);
        }
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $data = Input::only('first_name', 'last_name', 'email', 'phone', 'is_active', 'street', 'npa', 'city', 'country');
        $response = Member::validate($data, Member::$create_rules);
        if ($response === true) {
            $response = self::save('Member', $data);
        }
        return Jsend::compile($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $data = Input::only('first_name', 'last_name', 'email', 'phone', 'is_active', 'street', 'npa', 'city', 'country');
        $response = Member::validate($data, Member::$update_rules);
        if ($response === true) {
            $response = self::modify('Member', $id, $data);
        }
        return Jsend::compile($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        return Jsend::compile(self::delete('Member', $id));
    }

}
