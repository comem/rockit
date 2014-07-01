<?php

namespace Rockit;

use Rockit\Models\CompletePivotModelTrait;

/**
 * Contains the attributes and methods of a Staff model.<br>
 * A Staff is the relationship between an Event, a Member employed for that Event and a Skill that this Member can execute.<br>
 * Based on the Laravel's Eloquent.<br>
 * 
 * @author generated with Laravel Schema Designer <laravelsd.com>
 * @author Joël Gugger <joel.gugger@heig-vd.ch>
 */
class Staff extends \Eloquent {

    use CompletePivotModelTrait;

    protected $table = 'staffs';
    protected $hidden = ['event_id', 'member_id', 'skill_id'];

    /**
     * Indicates whether this model uses laravel's timestamps.
     * @var boolean 
     */
    public $timestamps = false;

    /**
     * Indicates which field value should be used in the return messages.
     * @var string 
     */
    public static $response_field = 'id';

    /**
     * Validations rules for creating a new Staff.
     * @var array 
     */
    public static $create_rules = [
        'member_id' => 'integer|required|min:1|exists:members,id',
        'event_id' => 'integer|required|min:1|exists:events,id',
        'skill_id' => 'integer|required|min:1|exists:skills,id',
    ];

    /**
     * Validation rules for updating an existing Staff.
     * @var array 
     */
    public static $update_rules = [
        'skill_id' => 'integer|min:1|exists:skills,id',
    ];

    /**
     * Validations rules for creating a new Event with a new employed Staff.
     * @var array 
     */
    public static $create_event_rules = [
        'member_id' => 'integer|required|min:1|exists:members,id',
        'skill_id' => 'integer|required|min:1|exists:skills,id',
    ];

    

    /**
     * Get the Skill to which a Staff is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function skill() {
        return $this->belongsTo('Rockit\Skill');
    }

    /**
     * Get the Member to which a Staff is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function member() {
        return $this->belongsTo('Rockit\Member');
    }

    /**
     * Get the Event to which a Staff is related.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function event() {
        return $this->belongsTo('Rockit\Event');
    }

    /**
     * Check if a Member can fulfill a Skill, with the provided member id and skill id .
     *
     * If the Member corresponding to the member id provided can not fulfill the Skill corresponding to the skill id provided, a <b>Jsend:fail</b> is returned.<br> 
     * Or else a boolean 'true' is returned.<br>
     *
     * @return a boolean 'true' or a Jsend:fail message
     */
    public static function checkMemberFulfillment($member_id, $skill_id) {
        $fulfillment = Fulfillment::where('member_id', '=', $member_id)->where('skill_id', '=', $skill_id)->first();
        if (is_object($fulfillment)) {
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

    /**
     * Check if an Event needs a Skill, with the provided event id and skill id.
     *
     * If the Skill corresponding to the skill id provided is not needed by the Event corresponding to the event id provided, a <b>Jsend:fail</b> is returned.<br>
     * Or else a boolean 'true' is returned.<br>
     *
     * @return a boolean 'true' or a Jsend:fail message
     */
    public static function checkEventNeed($event_id, $skill_id) {
        $need = Need::where('event_id', '=', $event_id)->where('skill_id', '=', $skill_id)->first();
        if (is_object($need)) {
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

    /**
     * Check if a Staff exists, with the provided member id and event id.
     *
     * @param array $data Data that contains a member_id and an event_id
     * @return Null or a Staff object
     */
    public static function existByIds($data) {
        return self::where('member_id', '=', $data['member_id'])->where('event_id', '=', $data['event_id'])->first();
    }

    public static function isUnique( array $array ){
        $newTab = [];
        foreach( $array as $object ){
            if( !in_array($object['member_id'], $newTab) ){
                $newTab[] = $object['member_id'];
            }
        }
        return count( $array ) === count( $newTab );
    }

}
