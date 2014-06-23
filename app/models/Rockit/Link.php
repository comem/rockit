<?php

namespace Rockit;

class Link extends \Eloquent {

    protected $table = 'links';
    public $timestamps = false;
    public static $create_rules = array(
        'url' => 'url|required|min:400',
        'name_de' => 'required|max:200',
        'title_de' => 'max:50'
    );
    public static $update_rules = array(
        'artist_id' => 'integer|required|max:10',
        'url' => 'url|required|min:400',
        'name_de' => 'required|max:200',
        'title_de' => 'max:50'
    );

    public function artist() {
        return $this->belongsTo('Rockit\Artist');
    }

    public static function exist($id) {
        if (is_numeric($id)) {
            $response = self::find($id);
        } else {
            $response = self::where('url', '=', $id)->first();
        }
        if ($response == NULL) {
            $response['fail'] = trans('fail.link.inexistant');
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
                'title' => trans('success.link.created'),
                'id' => $object->id,
            );
        } else {
            $response['error'] = trans('error.link.created');
        }
        return $response;
    }

    public static function updateOne($new_values, Link $object) {
        foreach ($new_values as $key => $value) {
            $object->$key = $value;
        }
        if ($object->save()) {
            $response['success'] = array(
                'title' => trans('success.link.updated'),
            );
        } else {
            $response['error'] = trans('error.link.updated');
        }
        return $response;
    }

    public static function deleteOne(Link $object) {
        if ($object->delete()) {
            $response['success'] = array(
                'title' => trans('success.link.deleted'),
            );
        } else {
            $response['error'] = trans('error.link.deleted');
        }
        return $response;
    }

}
