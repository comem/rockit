<?php

namespace Rockit;

use Rockit\Models\SimplePivotModelTrait;

class Fulfillment extends \Eloquent {

    use SimplePivotModelTrait;

    public $timestamps = false;
    protected $table = 'fulfillments';
    protected $hidden = ['member_id', 'skill_id'];
    public static $create_rules = [
        'member_id' => 'integer|required|min:1|exists:members,id',
        'skill_id' => 'integer|required|min:1|exists:skills,id',
    ];
    public static $response_field = 'id';

    public function skill() {
        return $this->belongsTo('Rockit\Skill');
    }

}
