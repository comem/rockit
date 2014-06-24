<?php

namespace Rockit\v1;

use \Input,
    \Jsend,
    \Rockit\Ticket,
	Rockit\Controllers\CompletePivotControllerTrait;

class TicketController extends \BaseController {

	use CompletePivotControllerTrait;

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = Input::only('amount', 'quantity_sold', 'comment_de', 'event_id', 'ticket_category_id');
		$response = Ticket::validate($data, Ticket::$create_rules);
        if ($response === true) {
            $response = self::save('Ticket', $data);
        }
        return Jsend::compile($response);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$data = Input::only('amount', 'quantity_sold', 'comment_de');
		$response = Ticket::validate($data, Ticket::$update_rules);
        if ($response === true) {
            $response = self::modify('Ticket', $id, $data);
        }
        return Jsend::compile($response);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		return Jsend::compile(self::delete($id));
	}    

	/**
     * 
     * @param 
     * @param 
     */
    public static function delete($id) {
        $object = Ticket::exist($id);
        if ($object == null) {
            $response = array(
                'fail' => array(
                    'title' => trans('fail.' . snake_case($model) . '.inexistant'),
                ),
            );
        } else {
        	$response = Ticket::isLastTicket($object);
        	if($response === false){
        		$response = Ticket::deleteOne($object);
        	}
        }
        return $response;
    }


}
