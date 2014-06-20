<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Genre extends \Eloquent {

	protected $table = 'genres';
	public $timestamps = false;
	protected $dates = array('deleted_at');

	static $rules = array(
		'id' => 'integer|min:1|required',
        'name_de' => 'required|alpha_num',
		);

	public function artists()
	{
		return $this->belongsToMany('Rockit\Artist');
	}

	public static function exist($id)
	{
        return self::find($id) != NULL;
	} 

	public static function create($data)
	{
		$genre = new self();
		$genre->name_de = $data['name_de'];

		//$genre = Genre::create(array('name_de' => $data['name_de']));
        
        try {
            $genre->save();
            Jsend::success("success message to define");
        } catch (Exception $e) {
            Jsend::fail("fail message to define");
        }
        return "saved?";
    }

    public static function validate($data)
	{ 
		//alpha_num
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $result = $validator->messages()
            //->getMessages();
        } else {
            $result = TRUE;
        }
        return $result;
	}

	public static function merge()
	{
		//
	}

	public static function archive($id)
	{
		self::find($id)->delete();
	}

	public static function restore($id)
	{
		self::find($id)->restore();
	}

}