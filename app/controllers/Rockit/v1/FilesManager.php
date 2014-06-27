<?php

namespace Rockit\v1;

use \Input,
    \Validator,
    \Jsend,
    \File,
    \Response,
    \Symfony\Component\HttpFoundation\File\UploadedFile;

class FilesManager extends \BaseController {

    /**
     * The folder that will contains the artists' and events' images.
     */
    const IMAGE_FOLDER = 'images';

    /**
     * The folder that will contains the events' contracts.
     */
    const CONTRACT_FOLDER = 'contracts';

    /**
     * The folder that will contains the events' printings.
     */
    const PRINTING_FOLDER = 'printings';

    /**
     * The validation rules for a image file.
     * 
     * Has to be either a <b>.jpeg</b>, <b>.png</b> or <b>.gif</b> file.<br>
     * Has to weight more than <b>1 byte</b> and less than <b>2 Mb</b>.<br>
     * 
     * @var array 
     */
    public $image_rules = array(
        'file' => 'image|max:2000|min:1',
    );

    /**
     * The validation rules for a contract file.
     * 
     * Has to be either a <b>.doc</b> or <b>.docx</b> file.<br>
     * Has to weight more than <b>1 byte</b> and less than <b>2 Mb</b>.
     * 
     * @var array
     */
    public $contract_rules = array(
        'file' => 'ext:doc,docx,pdf|max:2000|min:1',
    );

    /**
     * The validation rules for a printing file.
     * 
     * Has to be a <b>.pdf</b> file.
     * Has to weight more than <b>1 byte</b> and less than <b>5 Mb</b>.
     * 
     * @var array 
     */
    public $printing_rules = array(
        'file' => 'ext:pdf|max:5000|min:1',
    );

    /*
      |-----------------------------------------------------------------
      | APPLICATION SERVICES
      |-----------------------------------------------------------------
     */

    /**
     * Get from the server an existing image file designated by its source.
     * 
     * The source is the server-side name of the file, available via the source attribute of an Image model.<br>
     * The full path for this file is composed of :<br>
     * <i>public_path() result + IMAGE_FOLDER value + source value.</i><br>
     * The returned file is named after the original file name.<br>
     * 
     * @param string $source The server-side name of the file.
     * @return \Illuminate\Http\Response
     */
    public function getImage($source) {
        $complete_path = public_path() . DIRECTORY_SEPARATOR . self::IMAGE_FOLDER . DIRECTORY_SEPARATOR . $source;
        if (File::exists($complete_path)) {
            $file_name = preg_replace('#^[0-9]*\_#u', '', $source);
            return Response::download($complete_path, $file_name);
        }
    }

    /**
     * Get from the server an existing contract file designated by its source.
     * 
     * The source is the server-side name of the file, available via the source attribute of an Image model.<br>
     * The full path for this file is composed of :<br>
     * <i>storage_path() result + CONTRACT_VALUE value + source value.</i><br>
     * The returned file is named after the original file name.<br>
     * 
     * @param string $source The server-side name of the file.
     * @return \Illuminate\Http\Response
     */
    public function getContract($source) {
        $complete_path = storage_path() . DIRECTORY_SEPARATOR . self::CONTRACT_FOLDER . DIRECTORY_SEPARATOR . $source;
        if (File::exists($complete_path)) {
            $file_name = preg_replace('#^[0-9]*\_#u', '', $source);
            return Response::download($complete_path, $file_name);
        }
    }

    /**
     * Get from the server an existing printing file designated by its source.
     * 
     * The source is server-side name of the file, available via the source attribute of an Image model.<br>
     * The full path for this file is composed of :<br>
     * <i>storage_path() result + PRINTING_FOLDER value + source value.</i><br>
     * The returned file is named after the original file name.<br>
     * 
     * @param string $source The server-side name of the file.
     * @return \Illuminate\Http\Response
     */
    public function getPrinting($source) {
        $complete_path = storage_path() . DIRECTORY_SEPARATOR . self::PRINTING_FOLDER . DIRECTORY_SEPARATOR . $source;
        if (File::exists($complete_path)) {
            $file_name = preg_replace('#^[0-9]*\_#u', '', $source);
            return Response::download($complete_path, $file_name);
        }
    }

    /**
     * Upload a provided image to the server. Providing that it respects the specifications.<br>
     * 
     * The file is retrieved by an input field named 'file'.<br>
     * The type of the file is automatically guessed using its extension. The correct methods are then called depending on the guessed type.<br>
     * If the file is not valid a <b>Jsend::fail</b> is returned.<br>
     * If the file does not respect any of the declared statis rules a <b>Jsend::fail</b> is returned.<br>
     * If the file is valid, its name is prefixed by the current timestamp, and the file is moved to its correct directory.<br>
     * If the move is a success, a <b>Jsend::success</b> is returned containing the path used to download the file (or access it if it's an image).<br> 
     * If anything goes wrong throughout the process, a <b>Jsend::error</b> is returned.<br>
     * 
     * @return Jsend success: the file has been uploaded | fail: an error occured | error: a server-side error occured
     */
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

    /**
     * Delete from the server an existing file designated by its directory and its filename.<br>
     * 
     * The directory values are limited to the three folders in which files can be uploaded.<br>
     * These folders are : <b>images</b>, <b>contracts</b>, <b>printings</b>.<br>
     * If any other value is used, a <b>Jsend::fail</b> is returned.<br>
     * 
     * @param string $directory The directory in whitch the file is located
     * @param string $file_name The name of the file
     * @return Jsend success: the file has been deleted | fail: the file doesn't exist | error: the file hasn't been deleted
     */
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
            $response = array('fail' => array('title' => trans('fail.file.inexistant')));
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
