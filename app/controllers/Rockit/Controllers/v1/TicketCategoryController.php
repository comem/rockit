<?php

namespace Rockit\Controllers\v1;

use \Input,
    Rockit\Helpers\Jsend,
    \Rockit\Models\TicketCategory,
    \Rockit\Traits\Controllers\ControllerBSRDTrait;

/**
 * Contains interaction methods to the TicketCategory model in the database.<br>
 * Based on the Laravel's BaseController.<br>
 * Can : <b>index</b> all the TicketCategories, <b>store</b> and <b>destroy</b> one TicketCategory.<br>
 * Since TicketCategories can be linked to an event, the <b>delete</b> is actually a <b>softDelete</b>.
 * 
 * @author Robert di Rosa <robert.dirosa@heig-vd.ch>
 */
class TicketCategoryController extends \BaseController {

    use ControllerBSRDTrait;

    /**
     * Display a listing of the resource.
     * 
     * Each TicketCategory is returned with its own information. 
     * 
     * @return Jsend
     */
    public function index() {
        return Jsend::success(['response' => TicketCategory::all()->toArray()]);
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
        $data = Input::only('name_de');
        $response = self::renew('TicketCategory', $data);
        if ($response === false) {
            $response = TicketCategory::validate($data, TicketCategory::$create_rules);
            if ($response === true) {
                $response = self::save('TicketCategory', $data, TRUE, 'name_de');
            }
        }
        return Jsend::compile($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * If the provided id does not point to an existing TicketCategory, a <b>Jsend::fail</b> is returned.<br>
     * Or else this id is then passed to the <b>delete()</b> method that deletes the corresponding model.
     * 
     * @param int $id The id of the requested TicketCategory
     * @return Jsend
     */
    public function destroy($id) {
        return Jsend::compile(self::delete('TicketCategory', $id));
    }

}
