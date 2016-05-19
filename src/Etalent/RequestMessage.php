<?php

namespace Madetalent\Etalentsoap\Etalent;

class RequestMessage
{

    const STATUS_SUCCESS = 'success';
    const STATUS_ERROR = 'error';
    const STATUS_WARNING = 'warning';

    public static function response($data = null, $message = '', $status = self::STATUS_SUCCESS)
    {
        return response()->json(['status' => $status, 'message' => $message, 'response' => $data]);
    }

    public static function error(\Exception $e)
    {
        return self::response(null, $e->getMessage(), self::STATUS_ERROR);
    }

    public static function success($data = null, $message = '')
    {
        return self::response($data, $message);
    }

    public static function warning($data = null, $message = '')
    {
        return self::response($data, $message, self::STATUS_WARNING);
    }
}