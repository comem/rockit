<?php

namespace Rockit\v1;

use \Input,
    \Jsend,
    \Rockit\Description,
    Rockit\Controllers\SimplePivotControllerTrait;

/**
 * Contains interaction methods to the Description model in the database.<br>
 * Based on the Laravel's BaseController.<br>
 * Can : <b>store</b> and <b>destroy</b> one Description<br>
 * A Description is the link between an Artist and a Genre.<br>
 * 
 * @author Joël Gugger <joel.gugger@heig-vd.ch>
 */
class DescriptionController extends \BaseController {

    use SimplePivotControllerTrait;

    /**
     * Store a newly created resource in storage.
     * 
     * Get the adequate inputs from the client request and test that each of them pass the validation rules.<br>
     * If any of these inputs fails, a <b>Jsend::fail</b> is returned.<br>
     * If all the inputs are valid, the data is then passed to the <b>save()</b> method, who sends back a response.<br>
     *
     * @return Jsend
     */
    public function store() {
        $data = Input::only('genre_id', 'artist_id');
        $response = Description::validate($data, Description::$create_rules);
        if ($response === true) {
            $response = self::save('Description', $data);
        }
        return Jsend::compile($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * Destroys the Description that matches the provided id by passing this id to the <b>delete()</b> method, who sends back a response.<br>
     * A <b>Jsend::fail</b> is returned if the id does not point to an existing Description.
     * 
     * @param int $id The id of the Description to destroy
     * @return Jsend
     */
    public function destroy($id) {
        return Jsend::compile(self::delete($id));
    }

    /**
     * Remove the specified resource from the database.
     *
     * If the provided id does not point to an existing Description, a <b>Jsend::fail</b> is returned.<br>
     * If this is an Artist's last existing Description, a <b>Jsend::fail</b> is returned.<br>
     * Or else the Description is passed to the <b>deleteOne()</br> method of the Description model to be deleted.
     * 
     * @param int $id The id of the Description to delete
     * @return array Contains an array with either a <b>fail</b>, <b>error</b> or <b>success</b> key and its corresponding message
     */
    public static function delete($id) {
        $object = Description::exist($id);
        if ($object == null) {
            $response = array(
                'fail' => array(
                    'title' => trans('fail.description.inexistant'),
                ),
            );
        } else {
            $response = Description::isLastGenre($object);
            if ($response === false) {
                $response = Description::deleteOne($object);
            }
        }
        return $response;
    }

}
