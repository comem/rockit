<?php

namespace Rockit\Controllers\v1;

use \Input,
    \Validator,
    \Jsend,
    \File,
    \Response,
    \Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Contains interaction methods that are used when uploading a file to the database.<br>
 * Based on the Laravel's BaseController.<br>
 * Can : <b>upload</b> a file, <b>getImage</b>, <b>getContract</b>, <b>getPrinting</b> and <b>destroy</b> a file.<br>
 * 
 * @author Mathias Oberson <mathias.oberson@heig-vd.ch>
 */
class FilesManager extends \BaseController {

    /**
     * The folder that will contain the artists' and events' images.
     */
    const IMAGE_FOLDER = 'images';

    /**
     * The folder that will contain the events' contracts.
     */
    const CONTRACT_FOLDER = 'contracts';

    /**
     * The folder that will contain the events' printings.
     */
    const PRINTING_FOLDER = 'printings';

    /**
     * The validation rules for an image file.
     * 
     * Has to be either a <b>.jpeg</b>, <b>.png</b> or <b>.gif</b> file.<br>
     * Has to weigh more than <b>1 byte</b> and less than <b>2 Mb</b>.<br>
     * 
     * @var array 
     */
    public $images_rules = array(
        'file' => 'image|max:2000|min:1',
    );

    /**
     * The validation rules for a contract file.
     * 
     * Has to be either a <b>.doc</b> or <b>.docx</b> file.<br>
     * Has to weigh more than <b>1 byte</b> and less than <b>2 Mb</b>.
     * 
     * @var array
     */
    public $contracts_rules = array(
        'file' => 'ext:doc,docx,pdf|max:2000|min:1',
    );

    /**
     * The validation rules for a printing file.
     * 
     * Has to be a <b>.pdf</b> file.
     * Has to weigh more than <b>1 byte</b> and less than <b>5 Mb</b>.
     * 
     * @var array 
     */
    public $printings_rules = array(
        'file' => 'ext:pdf|max:5000|min:1',
    );

    /*
      |-----------------------------------------------------------------
      | APPLICATION SERVICES
      |-----------------------------------------------------------------
     */

    /**
     * Get an existing image file from the server, designated by its source.
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
            $file_name = $this->cleanFileName($source);
            return Response::download($complete_path, $file_name);
        }
    }

    /**
     * Get an existing contract file from the server, designated by its source.
     * 
     * The source is the server-side name of the file, available via the contract_src attribute of an Event model.<br>
     * The full path for this file is composed of :<br>
     * <i>storage_path() result + CONTRACT_FOLDER value + source value.</i><br>
     * The returned file is named after the original file name.<br>
     * 
     * @param string $source The server-side name of the file.
     * @return \Illuminate\Http\Response
     */
    public function getContract($source) {
        $complete_path = storage_path() . DIRECTORY_SEPARATOR . self::CONTRACT_FOLDER . DIRECTORY_SEPARATOR . $source;
        if (File::exists($complete_path)) {
            $file_name = $this->cleanFileName($source);
            return Response::download($complete_path, $file_name);
        }
    }

    /**
     * Get an existing printing file from the server, designated by its source.
     * 
     * The source is the server-side name of the file, available via the source attribute of a Printing model.<br>
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
            $file_name = $this->cleanFileName($source);
            return Response::download($complete_path, $file_name);
        }
    }

    /**
     * Upload a provided image to the server. Providing that it respects the specifications.<br>
     * 
     * The file is retrieved by an input field named 'file'.<br>
     * The type of the file is automatically guessed using its extension. The correct methods are then called depending on the guessed type.<br>
     * If the file is not valid a <b>Jsend::fail</b> is returned.<br>
     * If the file does not respect any of the declared status rules a <b>Jsend::fail</b> is returned.<br>
     * If the file is valid, its name is prefixed by the current timestamp, and the file is moved to the correct directory.<br>
     * If the move is a success, a <b>Jsend::success</b> is returned containing the path used to download the file (or the path to access it if it's an image).<br> 
     * If anything goes wrong throughout the process, a <b>Jsend::error</b> is returned.<br>
     * 
     * @return Jsend success: the file has been uploaded | fail: an error occurred | error: a server-side error occurred
     */
    public function upload($type) {
        $file = Input::file('file');
        if (is_object($file) && $file->isValid()) {
            $validation = $this->validate($file, $type);
            if (is_array($validation)) {
                $response = $validation;
            } else {
                $call = 'put' . studly_case($type);
                $response = $this->$call($file);
            }
        } else {
            $response['fail'] = ['file' => [trans('fail.file.invalid')]];
        }
        return Jsend::compile($response);
    }

    /**
     * Delete an existing file from the server, designated by its directory and its filename.<br>
     * 
     * The directory in which files can be uploaded are limited to the folders declared in the FilesManager class.<br>
     * These folders are by default : <b>images</b>, <b>contracts</b>, <b>printings</b>.<br>
     * If an invalid value is used, a <b>Jsend::fail</b> is returned.<br>
     * 
     * @param string $directory The directory in which the file is located
     * @param string $file_name The name of the file
     * @return Jsend success: the file has been deleted | fail: the file doesn't exist | error: the file hasn't been deleted
     */
    public function destroy($directory, $file_name) {
        if (preg_match('#' . self::IMAGE_FOLDER . '#u', $directory)) {
            $complete_path = public_path() . DIRECTORY_SEPARATOR . $directory . DIRECTORY_SEPARATOR . $file_name;
        } else {
            $complete_path = storage_path() . DIRECTORY_SEPARATOR . $directory . DIRECTORY_SEPARATOR . $file_name;
        }
        $file = $this->cleanFileName($file_name);
        if (File::exists($complete_path)) {
            if (File::delete($complete_path)) {
                $response['success'] = ['title' => trans('success.file.deleted', ['file' => $file])];
            } else {
                $response['error'] = trans('error.file.deleted', ['file' => $file]);
            }
        } else {
            $response['fail'] = ['file' => [trans('fail.file.inexistant', ['file' => $file])]];
        }
        return Jsend::compile($response);
    }

    /*
      |-----------------------------------------------------------------
      | INTERNAL FUNCTIONS
      |-----------------------------------------------------------------
     */

    private function validate(UploadedFile $file, $type) {
        $supported_type = Validator::make(['type' => $type], ['type' => 'required|in:images,printings,contracts']);
        if ($supported_type->fails()) {
            $response['fail'] = ['file_type' => [trans('fail.file_type.unsupported', ['type' => $type])]];
        } else {
            $rules = $type . '_rules';
            $response = Validator::make(['file' => $file], $this->$rules);
            if ($response->fails()) {
                $response = ['fail' => $response->messages()->getMessages()];
            } else {
                $response = true;
            }
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
            $response['success'] = [
                'title' => trans('success.file.uploaded', ['file' => $file->getClientOriginalName()]),
                'source' => $file->source,
            ];
        } else {
            $response['error'] = trans('error.file.uploaded', ['file' => $file->getClientOriginalName()]);
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

    private function cleanFileName($source) {
        return preg_replace('#^[0-9]*\_#u', '', $source);
    }

}
