<?php

namespace Rockit\Controllers\v1;

use \Input,
    Rockit\Helpers\Jsend,
    \Rockit\Models\Lineup,
    \Rockit\Traits\Controllers\SimplePivotControllerTrait;

/**
 * A Lineup links an Artist to its Musicians and the Instruments that those Musicians play.
 * Contains interaction methods to the Lineup model in the database.<br>
 * Based on the Laravel's BaseController.<br>
 * Can : <b>store</b> and <b>destroy</b> a Lineup.<br>
 * 
 * @author Joël Gugger <joel.gugger@heig-vd.ch>
 */
class LineupController extends \BaseController {

    use SimplePivotControllerTrait;

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
        $data = Input::only('musician_id', 'instrument_id', 'artist_id');
        $response = Lineup::validate($data, Lineup::$create_rules);
        if ($response === true) {
            $response = self::save('Lineup', $data);
        }
        return Jsend::compile($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * If the provided id does not point to an existing Lineup, a <b>Jsend::fail</b> is returned.<br>
     * Or else this id is then passed to the <b>delete()</b> method that deletes the corresponding model.
     * 
     * @param int $id The id of the requested Lineup
     * @return Jsend
     */
    public function destroy($id) {
        return Jsend::compile(self::delete($id));
    }

    /**
     * Remove the specified resource from the database.
     *
     * If the provided id does not point to an existing Lineup, a <b>Jsend::fail</b> is returned.<br>
     * If this Lineup includes the Artist's last Musician, a <b>Jsend::fail</b> is returned.<br>
     * Or else the Lineup is passed to the <b>deleteOne()</br> method of the Lineup model to be deleted.
     * 
     * @param int $id The id of the Lineup to delete
     * @return array Contains an array with either a <b>fail</b>, <b>error</b> or <b>success</b> key and its corresponding message
     */
    public static function delete($id) {
        $object = Lineup::exist($id);
        if ($object == null) {
            $response = array(
                'fail' => array(
                    'lineup' => [trans('fail.lineup.inexistant')],
                ),
            );
        } else {
            $response = Lineup::isLastLineup($object);
            if ($response === false) {
                $response = Lineup::deleteOne($object);
            }
        }
        return $response;
    }

}
