<?php

namespace Rockit\v1;

use \Input,
    \Validator,
    \Jsend;

class FilesManager extends \BaseController {

    public $image_rules = array(
        'file' => 'image|max:2000|min:1',
    );

    public function download() {
        return \Config::get('app.locale');
    }

    public function upload() {
        $file = Input::file('file');
        if ($file->isValid()) {
            $validate = Validator::make(array('file' => $file), $this->image_rules);
            if ($validate->passes()) {
                $response = array('success' => 'succès');
            } else {
                $response = array('fail' => $validate->messages());
            }
        } else {
            $response = array('fail' => trans('fail.file.invalid'));
        }
        return Jsend::compile($response);
    }

}
