<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait,
	Rockit\Models\ModelBCRDTrait;

class Skill extends \Eloquent {
    
	use SoftDeletingTrait,
		ModelBCRDTrait;

	protected $table = 'skills';
	protected $dates = ['deleted_at'];
	protected $hidden = ['deleted_at'];

	public $timestamps = false;
	public static $response_field = 'name_de';

	public static $create_rules = array(
		'name_de' => 'required',
	);

	public function members()
	{
		return $this->belongsToMany('Rockit\Member');
	}

    public function events() {
        return $this->belongsToMany('Rockit\Event')->withPivot('nb_people');
    }

    public function staffs() {
        return $this->hasMany('Rockit\Staff');
    }

}
