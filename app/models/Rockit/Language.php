<?php

namespace Rockit;

use \Validator;

class Language extends \Eloquent {

    protected $table = 'languages';
    public $timestamps = false;
    public static $create_rules = array(
        'locale' => 'alpha|required|min:2|max:2',
        'name' => 'alpha|required|min:2',
    );
    public static $update_rules = array(
        'locale' => 'alpha|min:2|max:2',
        'name' => 'alpha|min:2',
    );

    public function users() {
        return $this->hasMany('Rockit\User');
    }

    public static function exist($locale) {
        $response = self::where('locale', '=', $locale)->first();
        if ($response == NULL) {
            $response['fail'] = trans('fail.language.inexistant');
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
                'title' => trans('success.language.created'),
                'id' => $object->id,
            );
        } else {
            $response['error'] = trans('error.language.created');
        }
        return $response;
    }

    public static function updateOne($new_values, Language $object) {
        foreach ($new_values as $key => $value) {
            $object->$key = $value;
        }
        if ($object->save()) {
            $response['success'] = array(
                'title' => trans('success.language.updated'),
            );
        } else {
            $response['error'] = trans('error.language.updated');
        }
        return $response;
    }

    public static function deleteOne(Language $object) {
        if ($object->delete()) {
            $response['success'] = array(
                'title' => trans('success.language.deleted'),
            );
        } else {
            $response['error'] = trans('error.language.deleted');
        }
        return $response;
    }

    public static function restoreOne(Language $object) {
        if ($object->restore()) {
            $response['success'] = array(
                'title' => trans('success.language.restored'),
            );
        } else {
            $response['error'] = trans('error.language.restored');
        }
        return $response;
    }

}
