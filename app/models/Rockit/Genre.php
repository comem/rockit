<?php

namespace Rockit;

class Genre extends \Eloquent {
    
        use \Illuminate\Database\Eloquent\SoftDeletingTrait,
        Models\ModelBCRDTrait;
        
        public static $create_rules = array(
            'name_de' => 'required',
        );

	protected $table = 'genres';
	public $timestamps = false;

	public function artists()
	{
		return $this->belongsToMany('Rockit\Artist');
	}

}