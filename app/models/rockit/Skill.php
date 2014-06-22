<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait,
    Rockit\Models\ModelBCRDTrait;

class Skill extends \Eloquent {

    public $timestamps = false;
    protected $table = 'skills';
    protected $hidden = array('deleted_at');

    use SoftDeletingTrait,
        ModelBCRDTrait;

    protected $dates = ['deleted_at'];

    public function membersm() {
        return $this->belongsToMany('Rockit\Member');
    }

    public function events() {
        return $this->belongsToMany('Rockit\Event')->withPivot('nb_people');
    }

    public function staffs() {
        return $this->hasMany('Rockit\Staff');
    }

}
