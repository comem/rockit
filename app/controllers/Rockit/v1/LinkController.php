<?php

namespace Rockit\v1;

use \Input,
    \Jsend,
    Rockit\Link;

/**
 * Contains interaction methods to the Link model in the database.<br>
 * Based on the Laravel's BaseController.<br>
 * Can : <b>index</b> all the Links, <b>store</b> and <b>destroy</b> one Link.<br>
 * 
 * @author Christian Heimann <christian.heimann@heig-vd.ch>
 */
class LinkController extends \BaseController {

    use \Rockit\Controllers\ControllerBSUDTrait;

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
        $data = Input::only('url', 'name_de', 'title_de', 'artist_id');
        $response = Link::validate($data, Link::$create_rules);
        if ($response === true) {
            $response = self::save('Link', $data);
        }
        return Jsend::compile($response);
    }

    /**
     * Update the specified resource in storage.
     * 
     * If the provided id does not point to an existing Link, a <b>Jsend::fail</b> is returned.<br>
     * Get the adequate inputs from the client request and test that each of them pass the validation rules.<br>
     * If any a these inputs fail, a <b>Jsend::fail</b> is returned.<br>
     * If all the inputs are valid, the data is then passed to the <b>modify()</b> method.<br>
     *
     * @param int $id The id of the requested Link
     * @return Jsend
     */
    public function update($id) {
        $new_data = Input::only('url', 'name_de', 'title_de');
        $response = Link::validate($new_data, Link::$update_rules);
        if ($response === true) {
            $response = self::modify('Link', $id, $new_data);
        }
        return Jsend::compile($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * If the provided id does not point to an existing Link, a <b>Jsend::fail</b> is returned.<br>
     * Or else this id is then passed to the <b>delete()</b> method that deletes the corresponding model.
     * 
     * @param int $id The id of the requested Link
     * @return Jsend
     */
    public function destroy($id) {
        return Jsend::compile(self::delete('Link', $id));
    }

}
