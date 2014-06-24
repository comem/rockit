<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait,
	Rockit\Models\ModelBCRDTrait;

class Gift extends \Eloquent {

        use SoftDeletingTrait,
		ModelBCRDTrait; 
        
	protected $table = 'gifts';
	public $timestamps = false;

	use SoftDeletingTrait;
        public static $response_field = 'name_de';

	protected $dates = ['deleted_at'];

	public function events()
	{
		return $this->belongsToMany('Rockit\Event')->withPivot('quantity','cost','comment_de');
	}

}