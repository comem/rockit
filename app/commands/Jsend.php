<?php

class Jsend {

    const HTTP_SUCCESS = 200;
    const HTTP_SUCCESS_CREATED = 201;
    const HTTP_FAIL_VALIDATION = 400;
    const HTTP_FAIL_AUTH = 401;
    const HTTP_FAIL_ACL = 403;
    const HTTP_ERROR_NOT_FOUND = 404;
    const HTTP_ERROR_OTHER = 500;

    /**
     * Return a JSEND 'success' response with the provided HTTP status code.
     * If the status code is not provided, its default value is 200.
     *
     * @param mixed $data (Nullable) The data that will be returned
     * @param int $status (Nullable) The PHP status code that will be returned.
     * @return \Illuminate\Http\JsonResponse
     */
    public static function success($data = null, $status = null) {
        if (!isset($status)) {
            $status = self::HTTP_SUCCESS;
        }
        $rep = new stdClass();
        $rep->status = 'success';
        $rep->data = $data;
        // $rep->code = $status;
        return Response::json($rep);
    }

    /**
     * Return a JSEND 'fail' response with the provided HTTP status code.
     * If the status code is not provided, its default value is 400.
     *
     * @param mixed $data The data that will be returned
     * @param int $status (Nullable) The PHP status code that will be returned
     * @return \Illuminate\Http\JsonResponse
     */
    public static function fail($data, $status = null) {
        if (!isset($status)) {
            $status = self::HTTP_FAIL_VALIDATION;
        }
        $rep = new stdClass();
        $rep->status = 'fail';
        $rep->data = $data;
        // $rep->code = $status;
        return Response::json($rep);
    }

    /**
     * Return a JSEND 'error' response with the provided HTTP status code.
     * If the status code is not provided, its default value is 404.
     *
     * @param string $message The message returned to explain the error
     * @param int $status (Nullable) The PHP status code that will be returned
     * @return \Illuminate\Http\JsonResponse
     */
    public static function error($message, $status = null) {
        if (!isset($status)) {
            $status = self::HTTP_ERROR_NOT_FOUND;
        }
        $rep = new stdClass();
        $rep->status = 'error';
        $rep->message = $message;
        // $rep->code = $status;
        return Response::json($rep);
    }

    /**
     * Return the adequat JSEND response depending on the context.
     * The array of data provided MUST contains at least one item
     * referenced by a key value of either 'success', 'fail' or 'error'.
     * 
     * @param array $array The data that will be returned
     * @return \Illuminate\Http\JsonResponse
     */
    public static function compile($array) {
        if (isset($array['success'])) {
            $compile = self::success($array['success']);
        } elseif (isset($array['fail'])) {
            $compile = self::fail($array['fail']);
        } elseif (isset($array['error'])) {
            $compile = self::error($array['error']);
        }
        return $compile;
    }

}
