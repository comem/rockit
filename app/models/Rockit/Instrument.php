<?php

namespace Rockit;

class Instrument extends \Eloquent {

        use \Illuminate\Database\Eloquent\SoftDeletingTrait,
        Models\ModelBCRDTrait;
        
        public static $create_rules = array(
            'name_de' => 'required',
        );
    
	protected $table = 'instruments';
	public $timestamps = false;

	public function lineups()
	{
		return $this->hasMany('Rockit\Lineup');
	}
}