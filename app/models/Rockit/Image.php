<?php

namespace Rockit;

use Rockit\Models\ModelBCUDTrait,
    Rockit\Event,
    Illuminate\Database\Eloquent\SoftDeletingTrait;

class Image extends \Eloquent {

    use SoftDeletingTrait,
        ModelBCUDTrait;

    public static $create_rules = array(
        'source' => 'required|min:1|max:2000|path:images|unique:images',
        'alt_de' => 'max:100',
        'caption_de' => 'max:200',
    );
    public static $update_rules = array(
        'source' => 'min:1|max:2000|path:images|unique:images',
        'alt_de' => 'max:100',
        'caption_de' => 'max:200',
    );
    public $timestamps = true;
    protected $table = 'images';
    protected $hidden = array('deleted_at');
    protected $dates = array('deleted_at');
    public static $response_field = 'source';

    public function artist() {
        return $this->belongsTo('Rockit\Artist');
    }

    public function events() {
        return $this->hasMany('Rockit\Event');
    }

    public static function checkPerformer(Image $image, Event $event) {
        $response = Event::whereHas('performers', function ($q) use ($image) {
            $q->where('artist_id', '=', $image->artist_id);
        })->find($event->id);
        if ($response != NULL) {
            $response = true;
        } else {
            $response['fail'] = [
                'symbolization' => [trans('fail.symbolization.attach_image_not_performer')],
            ];
        }
        return $response;
    }

}
