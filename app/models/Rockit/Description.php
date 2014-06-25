<?php

namespace Rockit;

use Rockit\Models\SimplePivotModelTrait;

class Description extends \Eloquent {

	use SimplePivotModelTrait;

    protected $table = 'descriptions';

    public $timestamps = false;
	public static $create_rules = [
		'genre_id' 		=> 'integer|required|min:1|exists:genres,id',
		'artist_id' 	=> 'integer|required|min:1|exists:artists,id',
	];
	public static $response_field = 'id';

	public static function isLastGenre($object){
		$response = false;
		$genres = self::where('artist_id', '=', $object->artist_id)->count();
		if($genres < 2){
			$response = array(
                'fail' => array(
                    'title' => trans('fail.description.last_genre'),
                ),
            );
		}
		return $response;
	}

}
