<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait,
        Rockit\Models\ModelBCRDTrait;

class Gift extends \Eloquent {
    
        use SoftDeletingTrait,
		ModelBCRDTrait;

	protected $table = 'gifts';
        protected $dates = ['deleted_at'];
        
	public $timestamps = false;
        public static $response_field = 'name_de';

        public static $create_rules = array(
		'name_de' => 'required',
	);

	public function events()
	{
		return $this->belongsToMany('Rockit\Event')->withPivot('quantity','cost','comment_de');
	}

}