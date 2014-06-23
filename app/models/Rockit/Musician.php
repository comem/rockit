<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Musician extends \Eloquent {

    protected $table = 'musicians';
    public $timestamps = true;

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    public static $create_rules = array(
        'first_name' => 'required|min:1|max:100',
        'last_name' => 'max:100',
        'stagename' => 'max:100',
    );
    public static $update_rules = array(
        'first_name' => 'required|min:1|max:100',
        'last_name' => 'max:100',
        'stagename' => 'max:100',
    );

    public function lineups() {
        return $this->hasMany('Rockit\Lineup');
    }

    public static function exist($id) {
        $response = self::find($id);
        if ($response == NULL) {
            $response['fail'] = trans('fail.musician.inexistant');
        }
        return $response;
    }

    public static function validate($inputs, $rules) {
        $v = Validator::make($inputs, $rules);
        if ($v->fails()) {
            $response['fail'] = $v->messages()->getMessages();
        } else {
            $response = true;
        }
        return $response;
    }

    public static function createOne($inputs) {
        self::unguard();
        $object = self::create($inputs);
        if ($object != null) {
            $response['success'] = array(
                'title' => trans('success.musician.created'),
                'id' => $object->id,
            );
        } else {
            $response['error'] = trans('error.musician.created');
        }
        return $response;
    }

    public static function updateOne($new_values, Musician $object) {
        foreach ($new_values as $key => $value) {
            $object->$key = $value;
        }
        if ($object->save()) {
            $response['success'] = array(
                'title' => trans('success.musician.updated'),
            );
        } else {
            $response['error'] = trans('error.musician.updated');
        }
        return $response;
    }

    public static function deleteOne(Artist $object) {
        if ($object->delete()) {
            $response['success'] = array(
                'title' => trans('success.musician.deleted'),
            );
        } else {
            $response['error'] = trans('error.musician.deleted');
        }
        return $response;
    }
    
}
