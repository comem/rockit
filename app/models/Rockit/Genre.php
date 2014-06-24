<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait,
	Rockit\Models\ModelBCRDTrait;

class Genre extends \Eloquent {
    
	use SoftDeletingTrait,
		ModelBCRDTrait;

	protected $table = 'genres';
	protected $dates = ['deleted_at'];
	protected $hidden = ['deleted_at'];

	public $timestamps = false;
	public static $response_field = 'name_de';

	public static $create_rules = array(
		'name_de' => 'required',
	);

	public function artists()
	{
		return $this->belongsToMany('Rockit\Artist');
	}

	public static function mergeGenres(array $genresToMerge){
        return array_unique( $genresToMerge );
    }

}
