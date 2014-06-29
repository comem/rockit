<?php

namespace Rockit\v1;

use \Jsend,
    \Input,
    Rockit\Member,
    Rockit\Controllers\ControllerBSUDTrait;

/**
 * Contains interaction methods to the Member model in the database.<br>
 * Based on the Laravel's BaseController.<br>
 * Can : <b>index</b> all the Members, <b>show</b>, <b>destroy</b> and <b>update</b> one Member.<br>
 * Since Members can be linked to an event, the <b>delete</b> is actually a <b>softDelete</b>.
 * 
 * @author Mathias Oberson <mathias.oberson@heig-vd.ch>
 */
class MemberController extends \BaseController {

    use ControllerBSUDTrait;

    /**
     * Display a listing of the resource.
     * 
     * Each Member is returned with its own information. 
     * 
     * @return Jsend
     */
    public function index() {
        return Jsend::success(['response' => Member::all()]);
    }

    /**
     * Display the specified resource.
     * 
     * Return a Member with all of its relationships.<br>
     * If the provided id does not point to an existing Member, a <b>Jsend::fail</b> is returned.<br>
     *
     * @param int $id The id of the requested Member
     * @return Jsend
     */
    public function show($id) {
        $model = Member::with('staffs.event', 'staffs.skill', 'fulfillments.skill')->find($id);
        if (is_object($model)) {
            $response = Jsend::success(['response' => $model]);
        } else {
            $response = Jsend::fail(['member' => [trans('fail.member.inexistant')]]);
        }
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     * 
     * Get the adequate inputs from the client request and test that each of them pass the validation rules.<br>
     * If any a these inputs fails, a <b>Jsend::fail</b> is returned.<br>
     * If all the inputs are valid, the data is then passed to the <b>save()</b> method.<br>
     *
     * @return Jsend
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
     * If the provided id does not point to an existing Member, a <b>Jsend::fail</b> is returned.<br>
     * Get the adequate inputs from the client request and test that each of them pass the validation rules.<br>
     * If any a these inputs fail, a <b>Jsend::fail</b> is returned.<br>
     * If all the inputs are valid, the data is then passed to the <b>modify()</b> method.<br>
     *
     * @param int $id The id of the requested Member
     * @return Jsend
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
     * If the provided id does not point to an existing Member, a <b>Jsend::fail</b> is returned.<br>
     * Or else this id is then passed to the <b>delete()</b> method that deletes the corresponding model.
     * 
     * @param int $id The id of the requested Member
     * @return Jsend
     */
    public function destroy($id) {
        return Jsend::compile(self::delete('Member', $id));
    }

}
