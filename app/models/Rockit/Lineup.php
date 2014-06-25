<?php

namespace Rockit;

use Rockit\Models\SimplePivotModelTrait;

class Lineup extends \Eloquent {

	use SimplePivotModelTrait;

	protected $table = 'lineups';
	public static $create_rules = [
		'musician_id' 	=> 'integer|required|min:1|exists:musicians,id',
		'instrument_id' => 'integer|required|min:1|exists:instruments,id',
		'artist_id' 	=> 'integer|required|min:1|exists:artists,id',
	];
	public static $response_field = 'id';

	public $timestamps = false;

	public function instrument()
	{
		return $this->belongsTo('Rockit\Instrument');
	}

	public function artist()
	{
		return $this->belongsTo('Rockit\Artist');
	}

	public function musician()
	{
		return $this->belongsTo('Rockit\Musician');
	}

	public static function isLastLineup($object){
		$response = false;
		$lineup = Lineup::where('musician_id', '=', $object->musician_id)->count();
		if($lineup < 2){
			$response = array(
                'fail' => array(
                    'title' => trans('fail.lineup.last_lineup'),
                ),
            );
		}
		return $response;
	}

}