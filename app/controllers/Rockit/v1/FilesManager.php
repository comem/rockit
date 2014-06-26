<?php

namespace Rockit\v1;

use \Input,
    \Validator,
    \Jsend,
    \File,
    \Response,
    \Symfony\Component\HttpFoundation\File\UploadedFile;

class FilesManager extends \BaseController {

    const IMAGE_FOLDER = 'images';
    const CONTRACT_FOLDER = 'contracts';
    const PRINTING_FOLDER = 'printings';

    public $image_rules = array(
        'file' => 'image|max:2000|min:1',
    );
    public $contract_rules = array(
        'file' => 'ext:doc,docx|max:2000|min:1',
    );
    public $printing_rules = array(
        'file' => 'ext:pdf|max:5000|min:1',
    );

    /*
      |-----------------------------------------------------------------
      | APPLICATION SERVICES
      |-----------------------------------------------------------------
     */

    public function getImage($source) {
        $complete_path = public_path() . DIRECTORY_SEPARATOR . self::IMAGE_FOLDER . DIRECTORY_SEPARATOR . $source;
        if (File::exists($complete_path)) {
            $file_name = preg_replace('#^[0-9]*\_#u', '', $source);
            return Response::download($complete_path, $file_name);
        }
    }

    public function getContract($source) {
        $complete_path = storage_path() . DIRECTORY_SEPARATOR . self::CONTRACT_FOLDER . DIRECTORY_SEPARATOR . $source;
        if (File::exists($complete_path)) {
            $file_name = preg_replace('#^[0-9]*\_#u', '', $source);
            return Response::download($complete_path, $file_name);
        }
    }

    public function getPrinting($source) {
        $complete_path = storage_path() . DIRECTORY_SEPARATOR . self::PRINTING_FOLDER . DIRECTORY_SEPARATOR . $source;
        if (File::exists($complete_path)) {
            $file_name = preg_replace('#^[0-9]*\_#u', '', $source);
            return Response::download($complete_path, $file_name);
        }
    }

    public function upload() {
        $file = Input::file('file');
        if ($file->isValid()) {
            $file_type = $this->validate($file);
            if (is_array($file_type)) {
                $response = array('fail' => $file_type);
            } else {
                $call = 'put' . studly_case($file_type);
                $response = $this->$call($file);
            }
        } else {
            $response = array('fail' => trans('fail.file.invalid'));
        }
        return Jsend::compile($response);
    }

    public function destroy($directory, $file_name) {
        if (preg_match('#' . self::IMAGE_FOLDER . '#u', $directory)) {
            $complete_path = public_path() . DIRECTORY_SEPARATOR . $directory . DIRECTORY_SEPARATOR . $file_name;
        } else {
            $complete_path = storage_path() . DIRECTORY_SEPARATOR . $directory . DIRECTORY_SEPARATOR . $file_name;
        }
        if (File::exists($complete_path)) {
            if (File::delete($complete_path)) {
                $response = array('success' => array('title' => trans('success.file.deleted')));
            } else {
                $response = array('error' => trans('error.file.not_deleted'));
            }
        } else {
            $response = array('fail' => array('title' => trans('error.file.inexistant')));
        }
        return Jsend::compile($response);
    }

    /*
      |-----------------------------------------------------------------
      | INTERNALS FUNCTIONS
      |-----------------------------------------------------------------
     */

    private function validate(UploadedFile $file) {
        $validate = Validator::make(array('file' => $file), $this->image_rules);
        $type = self::IMAGE_FOLDER;
        if ($validate->fails()) {
            $validate = Validator::make(array('file' => $file), $this->contract_rules);
            $type = self::CONTRACT_FOLDER;
        }
        if ($validate->fails()) {
            $validate = Validator::make(array('file' => $file), $this->printing_rules);
            $type = self::PRINTING_FOLDER;
        }
        if ($validate->fails()) {
            $response = array('file' => trans('fail.file.unsupported'));
        } else {
            $response = $type;
        }
        return $response;
    }

    private function putPrintings(UploadedFile $file) {
        $file->name = date('Ymdhms_') . $file->getClientOriginalName();
        $file->source = self::PRINTING_FOLDER . '/' . $file->name;
        return $this->move($file, storage_path() . DIRECTORY_SEPARATOR . self::PRINTING_FOLDER);
    }

    private function putImages(UploadedFile $file) {
        $file->name = date('Ymdhms_') . $file->getClientOriginalName();
        $file->source = self::IMAGE_FOLDER . '/' . $file->name;
        return $this->move($file, public_path() . DIRECTORY_SEPARATOR . self::IMAGE_FOLDER);
    }

    private function putContracts(UploadedFile $file) {
        $file->name = date('Ymdhms_') . $file->getClientOriginalName();
        $file->source = self::CONTRACT_FOLDER . '/' . $file->name;
        return $this->move($file, storage_path() . DIRECTORY_SEPARATOR . self::CONTRACT_FOLDER);
    }

    private function move(UploadedFile $file, $path) {
        if ($this->checkOrCreate($path) && $file->move($path, $file->name)) {
            $response = array('success' => array(
                    'title' => trans('success.file.uploaded'),
                    'source' => $file->source,
            ));
        } else {
            $response = array('error' => trans('error.file.not_uploaded'));
        }
        return $response;
    }

    private function checkOrCreate($directory) {
        $ok = true;
        if (!File::exists($directory)) {
            $ok = File::makeDirectory($directory) ? $ok : !$ok;
        }
        return $ok;
    }

}
