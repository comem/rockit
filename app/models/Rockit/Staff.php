<?php

namespace Rockit;

use Rockit\Models\CompletePivotModelTrait;

class Staff extends \Eloquent {

	use CompletePivotModelTrait;

	protected $table = 'staffs';

	public $timestamps = false;
	public static $create_rules = [
		'member_id' 	=> 'integer|required|min:1|exists:members,id',
		'event_id'	 	=> 'integer|required|min:1|exists:events,id',
		'skill_id' 		=> 'integer|required|min:1|exists:skills,id',
	];
	public static $update_rules = [
		'skill_id' 		=> 'integer|required|min:1|exists:skills,id',
	];
	public static $response_field = 'id';

	public function skill()
	{
		return $this->belongsTo('Rockit\Skill');
	}

	public function member()
	{
		return $this->belongsTo('Rockit\Member');
	}

	public function event()
	{
		return $this->belongsTo('Rockit\Event');
	}

	public static function checkMemberFulfillment($member_id, $skill_id){
		$fulfillment = Fulfillment::where('member_id', '=', $member_id)->where('skill_id', '=', $skill_id)->first();
		if(is_object($fulfillment)){
			$response = true;
		} else {
			$response = array(
                'fail' => array(
                    'title' => trans('fail.fulfillment.non_assigned'),
                ),
            );
		}
		return $response;
	}

	public static function checkEventNeed($event_id, $skill_id){
		$need = Need::where('event_id', '=', $event_id)->where('skill_id', '=', $skill_id)->first();
		if(is_object($need)){
			$response = true;
		} else {
			$response = array(
                'fail' => array(
                    'title' => trans('fail.need.non_needed'),
                ),
            );
		}
		return $response;

	}


    public static function existByIds($data) {
        return self::where('member_id', '=', $data['member_id'])->where('event_id', '=', $data['event_id'])->first();
    }

}
