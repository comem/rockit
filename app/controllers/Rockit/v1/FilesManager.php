<?php

namespace Rockit\v1;

use \Input,
    \Validator,
    \Jsend,
    \Response;

class FilesManager extends \BaseController {

    const IMAGES_FOLDER = '\images\\';
    const CONTRACTS_FOLDER = '\contracts\\';
    const PRINTINGS_FOLDER = '\printings\\';

    public $image_rules = array(
        'file' => 'image|max:2000|min:1',
    );

    public function download($folder, $source_path) {
        $call = 'get' . studly_case(str_singular($folder));
        if (method_exists($this, $call)) {
            return $this->$call($source_path);
        }
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

    private function getImage($source) {
        return 'Image' . $source;
    }

    private function getContract($source) {
        return 'Contract' . $source;
    }

    private function getPrinting($source) {
        return 'Printing' . $source;
    }

}
