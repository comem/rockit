<?php

namespace Rockit;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Artist extends \Eloquent {

    protected $table = 'artists';
    public $timestamps = true;

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];
    public static $create_rules = array(
        'name' => 'required|min:1|max:100',
        'short_description_de' => 'max:200',
    );
    public static $update_rules = array(
        'name' => 'required|min:1|max:100',
        'short_description_de' => 'max:200',
    );

    public function links() {
        return $this->hasMany('Rockit\Link');
    }

    public function genres() {
        return $this->belongsToMany('Rockit\Genre');
    }

    public function images() {
        return $this->hasMany('Rockit\Image');
    }

    public function lineups() {
        return $this->hasMany('Rockit\Lineup');
    }

    public function events() {
        return $this->belongsToMany('Rockit\Event')->withPivot('order', 'is_support', 'artist_hour_of_arrival');
    }

    public static function exist($id) {
        $response = self::find($id)->first();
        if ($response == NULL) {
            $response['fail'] = trans('fail.artist.inexistant');
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
                'title' => trans('success.artist.created'),
                'id' => $object->id,
            );
        } else {
            $response['error'] = trans('error.language.created');
        }
        return $response;
    }

    public static function updateOne($new_values, Artist $object) {
        foreach ($new_values as $key => $value) {
            $object->$key = $value;
        }
        if ($object->save()) {
            $response['success'] = array(
                'title' => trans('success.artist.updated'),
            );
        } else {
            $response['error'] = trans('error.artist.updated');
        }
        return $response;
    }

    public static function deleteOne(Artist $object) {
        if ($object->delete()) {
            $response['success'] = array(
                'title' => trans('success.artist.deleted'),
            );
        } else {
            $response['error'] = trans('error.artist.deleted');
        }
        return $response;
    }

}
